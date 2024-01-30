<?php

function mb_ucfirst($string, $encoding) {
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then      = mb_substr($string, 1, null, $encoding);

    return mb_strtoupper($firstChar, $encoding) . $then;
}

// Price Page
function getdb() {

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
        exit();
    }

    return $mysqli;
}

// добавление плюса положительным числам
function numSign($num) {
    return ($num > 0) ? '+' . $num : $num;
}

// округление
function price_floor($num) {
    return $num + 0;
}

// первая строчная
function mb_lcfirst($str) {
    return mb_strtolower(mb_substr($str, 0, 1)) . mb_substr($str, 1);
}

// транслит
function translit($string) {
    $string = str_replace(' ', '-', $string);
    $string = str_replace('.', '-', $string);

    return $string;
}

function plot_chart_db($country) {

    // время выполнения
    $time_start = microtime(true);

    // коннект к БД
    $mysqli = getdb();

    if (isset($_GET['chart'])) {
        $stat_chart_id = (int) $_GET['chart'];
        echo $stat_chart_id;
    }

    // выбор таблички
    if (isset($country) && $country == 'Russia') {
        $table = 'oleo_price_russia';
    } else {
        $table = 'oleo_price_world';
    }

    // запрос полей, по которым выводим данные по индексу, полученному по ссылке
    $pre_query = "SELECT * FROM " . $table . " LIMIT 1";
    //	echo $pre_query;
    $pre_result = $mysqli->query($pre_query);
    if (empty($pre_result)) {
        echo 'Нет результатов по запросу';
        return;
    }
    $pre_row = $pre_result->fetch_assoc();

    // Устанавливаем дефолтные значения для GET-параметров

    //	$filter_country = htmlspecialchars($_GET['country']);
    //	$filter_basis = htmlspecialchars($_GET['basis']);
    //	$filter_period = htmlspecialchars($_GET['period']);

    if (isset($_GET['product'])) {
        $filter_product_name = $mysqli->real_escape_string($_GET['product']);
    } else {
        $filter_product_name = $pre_row['name'];
    }

    if (isset($_GET['country'])) {
        $filter_params  = explode("|", $mysqli->real_escape_string($_GET['country']));
        $filter_country = $filter_params[0];
        $filter_basis   = $filter_params[1];
    } else {
        $filter_country = $pre_row['country'];
        $filter_basis   = $pre_row['basis'];
    }

    if (isset($_GET['district'])) {
        $filter_district = $mysqli->real_escape_string($_GET['district']);
    } else {
        $filter_district = $pre_row['district'];
    }

    if (isset($_GET['period'])) {
        $filter_period = (int) $mysqli->real_escape_string($_GET['period']);
    } else {
        $filter_period = date('Y');
    }


    ///////////// Chart DB ////////////////


    // формируем запрос в зависимости от параметра $country
    // текущий год и предыдущий
    $where_date = ' AND YEAR(delivery_date) = ' . $filter_period;

    if (isset($country) && $country == 'Russia') {
        // Russia

        // выборка по delivery_date
        $fields = "*, ROUND(AVG(NULLIF(price ,0)), 0) as avg_price, DATE_FORMAT(delivery_date, '%m.%Y') as delivery_date, DATE_FORMAT(delivery_date, '%d.%m.%Y') as mydate";
        $where  = " name = '" . $filter_product_name . "' AND district = '" . $filter_district . "'" . $where_date;

        $query_filter1 = "SELECT DISTINCT name
FROM " . $table . " 
ORDER BY name DESC 
LIMIT 1000";

        $query_filter2 = "SELECT DISTINCT district
FROM " . $table . " 
WHERE `name` = '" . $filter_product_name . "'
ORDER BY `name` DESC 
LIMIT 1000";

        $query_filter3 = "SELECT DISTINCT NULLIF(YEAR(`delivery_date`) , YEAR(DATE_ADD(CURDATE(), INTERVAL 1 YEAR)) )
FROM " . $table . " 
WHERE `name` = '" . $filter_product_name . "' AND `district` = '" . $filter_district . "'
ORDER BY `delivery_date` 
LIMIT 1000";
    } else {
        // World
        // разница в отсутствии dictrict и наличии basis

        $fields = "*, ROUND(AVG(NULLIF(price ,0)), 0) as avg_price, DATE_FORMAT(delivery_date, '%m.%Y') as delivery_date, DATE_FORMAT(delivery_date, '%d.%m.%Y') as mydate, DATE_FORMAT(delivery_date, '%Y-%m') as monthDeliveryDate";
        $where  = " name = '" . $filter_product_name . "' AND country = '" . $filter_country . "' AND basis = '" . $filter_basis . "'" . $where_date;

        $query_filter1 = "SELECT DISTINCT name
FROM " . $table . " 
ORDER BY name DESC 
LIMIT 1000";

        $query_filter2 = "SELECT DISTINCT country, basis
FROM " . $table . "
WHERE `name` = '" . $filter_product_name . "'
ORDER BY `name` DESC 
LIMIT 1000";

        $query_filter3 = "SELECT DISTINCT NULLIF(YEAR(`delivery_date`) , YEAR(DATE_ADD(CURDATE(), INTERVAL 2 YEAR)) )
FROM " . $table . "
WHERE `name` = '" . $filter_product_name . "' AND `country` = '" . $filter_country . "' AND `basis` = '" . $filter_basis . "'
ORDER BY `delivery_date` 
LIMIT 1000";
    }


    $result_filter1 = $mysqli->query($query_filter1);
    if (empty($result_filter1)) {
        echo 'Нет результатов по запросу';
        return;
    }
    $result_filter2 = $mysqli->query($query_filter2);
    if (empty($result_filter2)) {
        echo 'Нет результатов по запросу';
        return;
    }
    $result_filter3 = $mysqli->query($query_filter3);
    if (empty($result_filter3)) {
        echo 'Нет результатов по запросу';
        return;
    }


    $query_old = "SELECT *, t1.id as id FROM " . $table .
        " AS t1 LEFT JOIN " . $table . "_diff AS t2
                ON t1.id = t2.set_id 
                WHERE date IN (SELECT max(date) FROM " . $table . " group by name) 
                LIMIT 100";

    $query = "SELECT " . $fields .
        " FROM " . $table .
        " WHERE " . $where .
        " GROUP BY YEAR(`delivery_date`), MONTH(`delivery_date`)" .
        " ORDER BY delivery_date LIMIT 1000";

    //	if ( current_user_can( 'administrator' ) ) {
    //	  echo $query;
    //  }

    $result = $mysqli->query($query);
    if (empty($result)) {
        echo 'Нет результатов по запросу';
        return;
    }


    ////////////// PLOT THE CHART //////////////

    $date_m = array(
        'январь',
        'февраль',
        'март',
        'апрель',
        'май',
        'июнь',
        'июль',
        'август',
        'сентябрь',
        'октябрь',
        'ноябрь',
        'декабрь'
    );

    $chart_data  = array();
    $chart_stats = array();

    //   $chart_data2 = array();

    while ($row = $result->fetch_assoc()) {

        if (!isset($chart_name)) { // пишем данные только в первом цикле
            $chart_name = $row['name'] . ' / ';
            $chart_name .= ((isset($country) && $country == 'Russia') ? $row['district'] : $row['basis']) . ' ';
            $chart_name .= $row['country'];
            $chart_name .= ((isset($country) && $country == 'Russia') ? '' : ('. Обзор цен от ' . $row['delivery_date'])) . ' ';
            $units      = $row['units'];
        }

        $price         = $row['avg_price'];
        $chart_stats[] = $row;
        if ($price != 0) {
            $date1 = strtotime(date("Y-m"));
            $date2 = strtotime($row['monthDeliveryDate']);

            //			$chart_data[] = sprintf("{ 'd' : '%s', 'p' : %s }", mb_convert_case( $date_m[ date('n', strtotime($row['mydate']) ) - 1 ] , MB_CASE_TITLE, "UTF-8"), $price);
            $chart_data[] = sprintf("{ 'd' : '%s', 'p' : %s, 'p-dash' : %s }", mb_convert_case($date_m[date('n', strtotime($row['mydate'])) - 1], MB_CASE_TITLE, "UTF-8") . ' ' . date('Y', strtotime($row['mydate'])), $price, ($date2 >= $date1) ? 5 : 0);
        }
    } // end while
?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.15/amcharts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.15/serial.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.15/themes/light.js" integrity="sha256-/8ddAVEjLXcC1w4acoVN5Xpp308AmeYauva/ws3o8SE=" crossorigin="anonymous"></script>

    <div class="chart">
        <header class="chart__filter">
            <form id="chart-filter" action="" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <label for="form-select1" class="chart-label">Продукт</label>
                        <select id="form-select1" name="product" class="chart-control" aria-label="Название продукта">
                            <?
                            while ($row = $result_filter1->fetch_row()) {
                                if (!empty($row[0])) {
                                    printf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_product_name == $row[0] ? 'selected' : ''), $row[0]);
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <? if (isset($country) && $country == 'Russia') : ?>
                        <div class="col-md-4">
                            <label for="form-select2" class="chart-label">Федеральный округ</label>
                            <select id="form-select2" name="district" class="chart-control" aria-label="Федеральный округ">
                                <?

                                $param_in_array = false;
                                $params_output  = '';
                                while ($row = $result_filter2->fetch_row()) {

                                    if ($filter_district == $row[0]) {
                                        $param_in_array = true;
                                    }
                                    if (!empty($row[0])) {
                                        $params_output .= sprintf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_district == $row[0] ? 'selected' : ''), $row[0]);
                                    }
                                }
                                // проверка на пустой GET-параметр или отсутствие его в выборке
                                if (empty($filter_district) or !($param_in_array)) {
                                    printf("<option selected></option>");
                                }
                                echo $params_output;

                                ?>
                            </select>
                        </div>
                    <? else : ?>
                        <div class="col-md-4">
                            <label for="form-select2" class="chart-label">Страна (базис)</label>
                            <select id="form-select2" name="country" class="chart-control" aria-label="Страна (базис)">
                                <?

                                $param_in_array = false;
                                $params_output  = '';
                                while ($row = $result_filter2->fetch_row()) {

                                    if ($filter_country == $row[0] && $filter_basis == $row[1]) {
                                        $param_in_array = true;
                                    }
                                    $params_output .= sprintf("<option value=\"%s|%s\" %s>%s (%s)</option>", $row[0], $row[1], (($filter_country == $row[0] && $filter_basis == $row[1]) ? 'selected' : ''), $row[0], $row[1]);
                                }
                                // проверка на пустой GET-параметр или отсутствие его в выборке
                                if ((empty($filter_country) or empty($filter_basis)) or !($param_in_array)) {
                                    printf("<option selected></option>");
                                }
                                echo $params_output;

                                ?>
                            </select>
                        </div>
                    <? endif; ?>
                    <div class="col-md-4">
                        <label for="form-select3" class="chart-label">Период</label>
                        <select id="form-select3" name="period" class="chart-control" aria-label="Период">
                            <?
                            while ($row = $result_filter3->fetch_row()) {
                                if (!empty($row[0])) {
                                    printf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_period == $row[0] ? 'selected' : ''), $row[0]);
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
            <script>
                // Init
                $(document).ready(function() {
                    console.log("ready!");
                    $("#chart-filter select")
                });

                $("#chart-filter select").on('change', function(e) {
                    $('#chart-filter').submit();
                });
            </script>
        </header>
        <div class="chart-comment">Средние цены, <?= $units ?></div>

        <div id="chart" style="height: 400px"></div>
    </div>

    <script>
        // World

        const chartData = [
            <?php echo join(',' . PHP_EOL, $chart_data) ?>
        ];
        const color = '#7fbc2b';

        // am4core.useTheme(am4themes_material);

        var chart = AmCharts.makeChart('chart', {
            type: "serial",
            theme: "light",
            language: "ru",
            color: "#333333",
            //"titles": [
            //    {
            //        "text": '<? //= $chart_title
                                ?>//',
            //        "size": 15,
            //        "color": "#626363",
            //        "bold": false,
            //    },
            //],
            legend: {
                useGraphSettings: true
            },
            dataProvider: chartData,
            chartCursor: {},
            allLabels: [],
            balloon: {},
            valueAxes: [{
                id: 'v1',
                // "minimum": 0
            }],
            graphs: [{
                id: "g2",
                valueAxis: 'v1',
                bullet: "round",
                bulletBorderAlpha: 1,
                bulletSize: 5,
                bulletColor: '#ffffff',
                hideBulletsCount: 50,
                lineThickness: 2,
                valueField: 'p',
                //title : "<?php //echo $chart_name
                            ?>//",
                balloonText: "[[value]] <?php echo $units; ?>",
                dashLengthField: 'p-dash',
                lineColor: color,
                useLineColorForBulletBorder: true,
                visibleInLegend: false
            }],
            categoryField: 'd',
            categoryAxis: {
                autoRotateAngle: true,
                labelRotation: 45
            },

            // 'lineColor': '#00ff00',
            // 'chooseGraphColor' : '#5c9314',
        });
    </script>
    <?php
    $time_exec = '(' . round(microtime(true) - $time_start, 4) . 's ) <br>' . PHP_EOL;

    return $time_exec;
}


function get_all_records_front($country) {
    // время выполнения
    $time_start = microtime(true);

    // инициализация
    $result_output  = '';
    $table_headings = array();


    // return $country;
    // получаем параметры и в зависимости от них устанавливаем заголовки и таблицу для выборки
    if (isset($country) && $country == 'all') {
        $table                 = 'oleo_price_world';
        $table_headings        = array(
            'Наименование',
            'Страна',
            'Базис',
            'Торги на',
            'Дата изм.',
            'Цена',
            'Ед. изм.',
            'За нед.',
            'За мес.',
            'Мин.',
            'Макс.',
            'График',
            'Файл'
        );
        $table_headings_hidden = array(0, 1, 0, 0, 1, 1, 2, 1, 1, 1, 1, 0, 0);
    } else {
        $table                 = 'oleo_price_russia';
        $table_headings        = array(
            'Наименование',
            'Страна',
            'Округ',
            'Дата изм.',
            'Цена (руб/т)',
            'За нед.',
            'За мес.',
            'Мин. за 24 мес.',
            'Макс. за 24 мес.',
            'График',
            'Файл'
        );
        $table_headings_hidden = array(0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0);
    }

    // коннект к БД
    $mysqli = getdb();

    // compact table class for big tables
    $table_class = '';

    // выборка по всем странам — формируем запрос и класс таблицы
    if (isset($country) && $country == 'all') {
        // запрашиваем все записи по полям имя - страна - дата поставки, не ранее текущего месяца

        /*
            $query111 = 'SELECT n.*
            FROM tblpm n
            INNER JOIN (
              SELECT control_number, MAX(date_updated) AS date_updated
              FROM tblpm GROUP BY control_number
            ) AS max USING (control_number, date_updated);
            ';
        */

        //  $query = "SELECT * FROM ".$table." AS t1 LEFT JOIN ".$table."_diff AS t2 ON t1.id = t2.set_id WHERE date IN (SELECT max(date) FROM ".$table." group by name) LIMIT 100";

        $table_class = 'price-table-big';
        // date -> delivery_date
        //		$my_new_query = "SELECT *  FROM `oleo_price_world` WHERE id IN (SELECT id WHERE `delivery_date` > LAST_DAY(now() - INTERVAL 1 MONTH) GROUP BY delivery_date) GROUP BY name, basis, delivery_date";

        //		$query = "SELECT *, t1.id as id FROM ".$table." AS t1, ".$table."_diff AS t2 WHERE t1.id = t2.set_id and date IN (SELECT max(date) FROM ".$table." group by name, basis, delivery_date ORDER BY delivery_date) ORDER BY name DESC LIMIT 500";
        // TODO: доделать запрос
        //	  $query = "SELECT *, t1.id as id FROM ".$table." AS t1, ".$table." AS t2 WHERE date IN (SELECT max(date) FROM ".$table." group by name, basis, delivery_date ORDER BY delivery_date) ORDER BY name DESC LIMIT 500";
//        $query_old = "SELECT `id`, `date`, `name`, `country`, `basis` FROM oleo_price_world
// WHERE oleo_price_world.date = (SELECT MAX(date) FROM oleo_price_world)
//  GROUP BY name, basis
//  ORDER BY name DESC LIMIT 100";

        $query = "SELECT a.* FROM `oleo_price_world` a INNER JOIN ( SELECT `name`, `basis`, MAX(`date`) as max_date FROM `oleo_price_world` GROUP BY name, basis ) b ON a.name = b.name AND a.basis = b.basis AND a.date = b.max_date GROUP BY `name`, `basis` ORDER BY `id`;";


        $query_max_date = "SELECT DATE_FORMAT(max(`date`), '%d.%m.%Y') FROM " . $table;
    } else {
        // выборка по России
        $query = "SELECT *, t1.id as id FROM " . $table . " AS t1 LEFT JOIN " . $table . "_diff AS t2 ON t1.id = t2.set_id WHERE date IN (SELECT max(date) FROM " . $table . " group by name) ORDER BY name DESC LIMIT 100";

        $query_max_date = "SELECT DATE_FORMAT(max(`date`), '%d.%m.%Y') FROM " . $table;

        //  $query = "SELECT * FROM ".$table." AS t1, ".$table."_diff AS t2 WHERE t1.id = t2.set_id and date IN (SELECT max(date) FROM ".$table.") LIMIT 100";
        //" WHERE date IN (SELECT max(date))";
    }

    if (current_user_can('administrator')) {
//        echo $query;
    }

    $result          = $mysqli->query($query);
    $result_max_date = $mysqli->query($query_max_date);

    // оформляем в табличку
    if ($result->num_rows > 0) {

        // ищем максимальную дату

        $max_date = '';

        $max_date = $result_max_date->fetch_row()[0];


        $result_output .= '<div class="prices-list">
<div class="prices-list__desc">' . $max_date . '</div>
<ul class="prices-list__items">';

        // Get Table headings
        /*
            foreach ($table_headings as $key => $value) {
                if ($table_headings_hidden[$key] == 1) {
                    $result_output .= '<th class="d-none d-md-table-cell">'.$value. '</th>';
                } elseif ($table_headings_hidden[$key] == 2) {
                    $result_output .= '<th class="d-none">'.$value. '</th>';
                } else {
                    $result_output .= '<th>'.$value.'</th>';
                }
            }

            $result_output .= "</tr></thead><tbody>";
        */

        // Get Table values
        while ($row = $result->fetch_assoc()) {

            $dwn_button = '<a class="btn btn-outline-secondary download-notice" href="#"><i class="fas fa-download"></i></a>';

            if (is_user_logged_in()) {
                $dwn_button = '<a class="btn btn-outline-secondary" href="' . home_url('/prices/download/') . '?dl=' . $row['id'] . '"><i class="fas fa-download"></i></a>';
            }

            // суммарный результат для одного округа по России
            $summary_result = array();

            if ($country == 'all') { // World
                //code,name,country,basis,@delivery_date,@delivery_date2,delivery_period,@date,units,@price

                // $table . '_diff';


                $result_output .= '<li class="prices-list__row"><a class="prices-list__item" href="' . home_url('/prices/chart/') . '?id=' . $row['id'] . '">
                       <span class="prices-list__item-name">' . $row['name'] . ' - ' . $row['country'] . ' (' . $row['basis'] . ')</span>
                       <span class="prices-list__item-date"> Обзор цен от ' . date('d.m.Y', strtotime($row['date'])) . '</span>
	                   </a></li>';
            } else { // Russia
                //				if ( !empty($row['name']) ) {
                //					$result_output .= '<tr>
                //                     <td>' . $row['name'] . '</td>
                //                     <td class="d-none d-md-table-cell">' . $row['country'] . '</td>
                //                     <td>' . $row['district'] . '</td>
                //                     <td class="d-none d-md-table-cell">' . date('d.m.Y', strtotime($row['date']) ). '</td>
                //                     <td class="d-none d-md-table-cell">' . price_floor($row['price']). '</td>
                //                     <td class="d-none d-md-table-cell"><span class="' . ( (abs($row['week_diff_price']) == $row['week_diff_price']) ? 'plus' : 'minus' ) . '">' . numSign(price_floor($row['week_diff_price'])) . '</span></td>
                //                     <td class="d-none d-md-table-cell"><span class="' . ( (abs($row['month_diff_price']) == $row['month_diff_price']) ? 'plus' : 'minus' ) . '">'. numSign(price_floor($row['month_diff_price'])) . '</span></td>
                //                     <td class="d-none d-md-table-cell">' . (isset($row['min_price']) ? price_floor($row['min_price']) : '–' ) . '</td>
                //                     <td class="d-none d-md-table-cell">' . (isset($row['max_price']) ? price_floor($row['max_price']) : '–' ) . '</td>
                //                     <td><a class="btn btn-outline-secondary" href="'. home_url('/prices/chart/') . '?idr=' . $row['id'] . '"><i class="fas fa-chart-area"></i></a></td>
                //                     <td>' . $dwn_button . '</td>
                //                     </tr>';
                //				}
            } // end if
        } // end while

        $result_output .= "</ul></div>";
    } else {
        $result_output .= "you have no records";
    }

    $time_exec = '(' . round(microtime(true) - $time_start, 4) . 's ) <br>' . PHP_EOL;

    return $result_output . $time_exec;
}


function import_csv($country) {
    // echo 'imported CSV file';

    return get_all_records_front($country);
}

function import_csv_db($country) {
    // echo 'imported CSV file';

    return plot_chart_db($country);
}

///////////////////////////////////////////
/////////// DOWNLOAD and Chart ////////////
///////////////////////////////////////////

function export_csv($id, $country, $chart) {
    // echo 'imported CSV file';

    $mysqli = getdb();

    if (isset($_GET['chart'])) {
        $stat_chart_id = (int) $_GET['chart'];
        echo $stat_chart_id;
    }

    // получаем ID поля по которому выводим данные
    if (isset($id) && $id != 0) {

        $stat_id = (int) $id;
        $fields  = '';

        // выбор таблички
        if ( isset( $country ) && $country == 'Russia' ) {
            $table = 'oleo_price_russia';
        } else {
            $table = 'oleo_price_world';
        }


        /**
         * Custom template tags for this theme.
         */

        // запрос полей, по которым выводим данные по индексу, полученному по ссылке
        $pre_query = "SELECT *, DATE_FORMAT(date, '%d.%m.%Y') as date, date as date_orig, DATE_FORMAT(delivery_date, '%c') as delivery_month FROM " . $table . " WHERE id = " . $stat_id . ";";
        if ( current_user_can( 'administrator' ) ) {
//            echo $pre_query. '<br>';
        }
        $pre_result = $mysqli->query($pre_query);
        if (empty($pre_result)) {
            echo 'Нет результатов по запросу';
            return;
        }
        $pre_row = $pre_result->fetch_assoc();

        // стоимость поставок на:
        $pre_query2 = "SELECT DATE_FORMAT(date, '%d.%m.%Y') as date, delivery_date, DATE_FORMAT(delivery_date, '%c') as delivery_month, ROUND(price) as price FROM `oleo_price_world` WHERE `name` = '" . $pre_row['name'] . "' AND `country` = '" . $pre_row['country'] . "' AND `basis` = '" . $pre_row['basis'] . "' AND `date` = '" . $pre_row['date_orig'] . "' ORDER BY `delivery_date` ASC;";
        if ( current_user_can( 'administrator' ) ) {
//            echo $pre_query2. '<br>';
        }
        $pre_result2 = $mysqli->query($pre_query2);
        if (empty($pre_result2)) {
            echo 'Нет результатов по запросу';
            return;
        }

        $pre_query3 = "SELECT DATE_FORMAT(date, '%d.%m.%Y') as date, ROUND(`price`) as price_max FROM `oleo_price_world` WHERE `name` = '" . $pre_row['name'] . "' AND `country` = '" . $pre_row['country'] . "' AND `basis` = '" . $pre_row['basis'] . "' AND `delivery_date` = '" . $pre_row['delivery_date'] . "' ORDER BY `price` DESC LIMIT 1;";
        if ( current_user_can( 'administrator' ) ) {
//            echo $pre_query3. '<br>';
        }
        $pre_result3 = $mysqli->query($pre_query3);
        if (empty($pre_result3)) {
            echo 'Нет результатов по запросу';
            return;
        }

        $pre_query4 = "SELECT DATE_FORMAT(date, '%d.%m.%Y') as date, ROUND(`price`) as price_min FROM `oleo_price_world` WHERE `name` = '" . $pre_row['name'] . "' AND `country` = '" . $pre_row['country'] . "' AND `basis` = '" . $pre_row['basis'] . "' AND `delivery_date` = '" . $pre_row['delivery_date'] . "' ORDER BY `price` ASC LIMIT 1;";
        $pre_result4 = $mysqli->query($pre_query4);
        if (empty($pre_result4)) {
            echo 'Нет результатов по запросу';
            return;
        }

        // Предыдущее значение
        $pre_query5 = "SELECT DATE_FORMAT(date, '%d.%m.%Y') as date_f, ROUND(`price`) as price_min FROM `oleo_price_world` WHERE `name` = '" . $pre_row['name'] . "' AND `country` = '" . $pre_row['country'] . "' AND `basis` = '" . $pre_row['basis'] . "' AND `delivery_date` = '" . $pre_row['delivery_date'] . "' ORDER BY `date` DESC LIMIT 1 OFFSET 1;";
        $pre_result5 = $mysqli->query($pre_query5);
        if (empty($pre_result5)) {
            echo 'Нет результатов по запросу';
            return;
        }
        if ( current_user_can( 'administrator' ) ) {
//            echo 'pre result: ' . $pre_query5. '<br>';
        }

        // " AND delivery_date = '". $pre_row['delivery_date']. "'"

        // формируем запрос в зависимости от параметра $country
        // текущий год и предыдущий
        $where_date = ' AND YEAR(delivery_date) >= YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))';

        if (isset($country) && $country == 'Russia') {
            // Russia

            // выборка по дате группами
            //			$fields = "*, ROUND(AVG(NULLIF(price ,0)), 0) as price, DATE_FORMAT(delivery_date, '%m.%Y') as delivery_date, DATE_FORMAT(date, '%d.%m.%Y') as mydate";
            //			$where = " name = '". $pre_row['name']. "' AND district = '". $pre_row['district']. "'" . $where_date;

            // выборка по delivery_date
            $fields = "*, ROUND(AVG(NULLIF(price ,0)), 0) as avg_price, DATE_FORMAT(delivery_date, '%m.%Y') as delivery_date, DATE_FORMAT(delivery_date, '%d.%m.%Y') as mydate";
            $where  = " name = '" . $pre_row['name'] . "' AND district = '" . $pre_row['district'] . "'" . $where_date;
        } else {
            // World
            // разница в отсутствии dictrict и наличии basis

            //			$fields = "*, ROUND(AVG(NULLIF(price ,0)), 0) as price, DATE_FORMAT(delivery_date, '%m.%Y') as delivery_date, DATE_FORMAT(date, '%d.%m.%Y') as mydate";
            //			$where = " name = '". $pre_row['name']. "' AND basis = '". $pre_row['basis']. "'" . $where_date;

            $fields = "*, ROUND(AVG(NULLIF(price ,0)), 0) as avg_price, DATE_FORMAT(delivery_date, '%m.%Y') as delivery_date, DATE_FORMAT(delivery_date, '%d.%m.%Y') as mydate, DATE_FORMAT(delivery_date, '%Y-%m') as monthDeliveryDate";
            $where  = " name = '" . $pre_row['name'] . "' AND country = '" . $pre_row['country'] . "' AND basis = '" . $pre_row['basis'] . "'" . $where_date;
        }
        $query = "SELECT " . $fields .
            " FROM " . $table .
            " WHERE " . $where .
            " GROUP BY YEAR(`delivery_date`), MONTH(`delivery_date`)" .
            "";
        //              " ORDER BY date, delivery_date LIMIT 1000";
        // сбивается порядок сортировки

        if (current_user_can('administrator')) {
//            echo '3 - ' . $query;
        }

        $result = $mysqli->query($query);
        if (empty($result)) {
            echo 'Нет результатов по запросу';
            return;
        }


        ////////////// PLOT THE CHART //////////////

        $date_m = array(
            'январь',
            'февраль',
            'март',
            'апрель',
            'май',
            'июнь',
            'июль',
            'август',
            'сентябрь',
            'октябрь',
            'ноябрь',
            'декабрь'
        );

        if (isset($chart)) {

            $chart_data  = array();
            $chart_stats = array();

            //   $chart_data2 = array();

            while ($row = $result->fetch_assoc()) {

                if (!isset($chart_name)) { // пишем данные только в первом цикле
                    $chart_name = $row['name'] . ' / ';
                    $chart_name .= ((isset($country) && $country == 'Russia') ? $row['district'] : $row['basis']) . ' ';
                    $chart_name .= $row['country'];
                    $chart_name .= ((isset($country) && $country == 'Russia') ? '' : ('. Обзор цен от ' . $pre_row['date'])) . ' ';

                    $units = $row['units'];

                    $chart_title = $row['name'] . ' (';
                    $chart_title .= ((isset($country) && $country == 'Russia') ? $row['district'] : $row['basis']) . ')';
                    //          $chart_title .=  $row['country'];
                    $chart_title .= ((isset($country) && $country == 'Russia') ? '' : (', средние цены, ' . $units)) . ' ';
                }

                $price         = $row['avg_price'];
                $chart_stats[] = $row;
                if ($price != 0) {
                    $date1 = strtotime(date("Y-m"));
                    $date2 = strtotime($row['monthDeliveryDate']);

                    $chart_data[] = sprintf("{ 'd' : '%s', 'p' : %s, 'p-dash' : %s }", mb_convert_case($date_m[date('n', strtotime($row['mydate'])) - 1], MB_CASE_TITLE, "UTF-8") . ' ' . date('Y', strtotime($row['mydate'])), $price, ($date2 >= $date1) ? 5 : 0);

                    $date2_last = $date2;
                }
            } // end while
    ?>
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.15/amcharts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.15/serial.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.15/themes/light.js" integrity="sha256-/8ddAVEjLXcC1w4acoVN5Xpp308AmeYauva/ws3o8SE=" crossorigin="anonymous"></script>

            <article class="chart">
                <!-- Обзор зарубежных цен со статистикой (prices-chart) -->
                <h2><?php echo $chart_name ?></h2>
                <? if (current_user_can('administrator')) : ?>
                        <? //echo 'Цена: ' . $chart_stats[0]['price'] . '<br>';
                        //echo ' Поставка: ' . $chart_stats[0]['mydate'] . ' - ' . $date_m[date('n', strtotime($chart_stats[0]['mydate'])) - 1]; ?>
                <? endif; ?>
                    <?php
                      $pre_row2 = array();
                      $i = 0;
                      while ($row = $pre_result2->fetch_assoc()) {
                        $pre_row2[] = $row;
                        $i++;
                      }
                      $prev_price = '';
                      $prev_date = '';
                      while ($pre_row5 = $pre_result5->fetch_assoc()) {
                        $prev_price = $pre_row5['price_min'];
                        $prev_date = $pre_row5['date_f'];
                      }
                    ?>
                    <p><?= isset($pre_row['date']) ? $pre_row['date'] . ' г.' :''; ?>
                      <?php if($pre_row2[0]['price'] != 0) { // no data ?>
                      цена на <?= str_replace("соя", "сою", mb_lcfirst($chart_stats[0]['name'])) ?>
                        (<?= $chart_stats[0]['basis'] ?>) с поставкой на <?= $date_m[$pre_row2[0]['delivery_month'] - 1]; ?>
                        составила <span title="<?= $chart_stats[0]['units'] ?>"><?= $pre_row2[0]['price']; ?></span> $/т
                      <?php $price_delta = (int)$pre_row2[0]['price'] - (int)$prev_price ?>
                      <?php if ((int)$prev_price != 0): ?>
                        , что на <?= abs($price_delta) ?> $/т <?= $price_delta > 0 ? 'выше': 'ниже' ?> предыдущего значения от <?= $prev_date ?> г. (<?= (int)$prev_price ?> $/т).
                      <?php endif; ?>
                    </p>

                    <p>
                        <?php while ($pre_row3 = $pre_result3->fetch_assoc()) { ?>
                            Максимальная цена поставки на <?= $date_m[$pre_row['delivery_month'] - 1]; ?> за последний месяц составляла <?= $pre_row3['price_max']; ?> $/т
                            (<?= $pre_row3['date']; ?> г.).
                        <?php } ?>
                        <?php while ($pre_row4 = $pre_result4->fetch_assoc()) { ?>
                          Минимальная цена - <?= $pre_row4['price_min']; ?> $/т (<?= $pre_row4['date']; ?> г.).
                        <?php } ?>

                    </p>


                    <p>От <?= $pre_row['date']; ?> стоимость поставок на:<br>
                      <?php for ($i = 0; $i < count($pre_row2); $i++) { ?>
                        - <?= $date_m[$pre_row2[$i]['delivery_month'] - 1]; ?> составила <?= $pre_row2[$i]['price']; ?> $/т<br>
                      <?php } ?>

                      <?php } else { ?>
                        Торги не проводились
                      <?php } // end no data ?>
                    </p>

                    <h3 class="d-none">График <span class="d-none d-md-table-cell">изменения котировок</span></h3>

                    <div id="chart" style="height: 400px"></div>
                    <div class="chart-comment">Прогноз формируется исходя из фьючерсов за последний месяц</div>
            </article>

            <script>
                // World

                const chartData = [
                    <?php echo join(',' . PHP_EOL, $chart_data) ?>
                ];
                const color = '#7fbc2b';

                // am4core.useTheme(am4themes_material);

                var chart = AmCharts.makeChart('chart', {
                    type: "serial",
                    theme: "light",
                    language: "ru",
                    color: "#333333",
                    "titles": [{
                        "text": '<?= $chart_title ?>',
                        "size": 15,
                        "color": "#626363",
                        "bold": false,
                    }, ],
                    legend: {
                        useGraphSettings: true
                    },
                    dataProvider: chartData,
                    chartCursor: {},
                    allLabels: [],
                    balloon: {},
                    valueAxes: [{
                        id: 'v1',
                        // "minimum": 0
                    }],
                    graphs: [{
                        id: "g2",
                        valueAxis: 'v1',
                        bullet: "round",
                        bulletBorderAlpha: 1,
                        bulletSize: 5,
                        bulletColor: '#ffffff',
                        hideBulletsCount: 50,
                        lineThickness: 2,
                        valueField: 'p',
                        //title : "<?php //echo $chart_name
                                    ?>//",
                        balloonText: "[[value]] <?php echo $units; ?>",
                        dashLengthField: 'p-dash',
                        lineColor: color,
                        useLineColorForBulletBorder: true,
                        visibleInLegend: false
                    }],
                    categoryField: 'd',
                    categoryAxis: {
                        autoRotateAngle: true,
                        labelRotation: 45
                    },

                    // 'lineColor': '#00ff00',
                    // 'chooseGraphColor' : '#5c9314',
                });
            </script>

    <?php


        }
    }
}


function plot_chart_multi($country) {

    // время выполнения
    $time_start = microtime(true);

    // коннект к БД
    $mysqli = getdb();

    if (isset($_GET['chart'])) {
        $stat_chart_id = (int) $_GET['chart'];
        echo $stat_chart_id;
    }

    // выбор таблички
    if (isset($country) && $country == 'Russia') {
        $Russia = true;
    }

    if ($Russia) {
        $table = 'oleo_price_fts';
    } else {
        $table = 'oleo_price_world_usda';
    }

    $pre_where = '';

    // запрос полей, по которым выводим данные по индексу, полученному по ссылке
    $pre_query = "SELECT * FROM " . $table . $pre_where . " LIMIT 1";

    if ( current_user_can( 'administrator' ) ) {
//        echo 'USDA / МЖО  <br>' . $pre_query . "<br><br>\n";
    }
    $pre_result = $mysqli->query($pre_query);
    if (empty($pre_result)) {
        echo 'Нет результатов по запросу';
        return;
    }
    $pre_row = $pre_result->fetch_assoc();

    // Устанавливаем дефолтные значения для GET-параметров

    if (isset($_GET['country'])) {
        $filter_country = $mysqli->real_escape_string($_GET['country']);
    } else {
        $filter_country = $pre_row['country'];
    }

    if (isset($_GET['type'])) {
        $filter_product_type = $mysqli->real_escape_string($_GET['type']);
    } else {
        $filter_product_type = $pre_row['product_type'];
    }

    if (isset($_GET['product'])) {
        $filter_product_name = $mysqli->real_escape_string($_GET['product']);
    } else {
        $filter_product_name = $pre_row['product_name'];
    }
    if ( current_user_can( 'administrator' ) ) {
        echo $filter_product_name;
    }

    if (isset($_GET['season'])) {
        $filter_season = $mysqli->real_escape_string($_GET['season']);
    } else {
        $filter_season = 11; // количество столбцов `period`
    }
    // Russia
    if (isset($_GET['operation'])) {
        $filter_operation = $mysqli->real_escape_string($_GET['operation']);
    } else {
        $filter_operation = $pre_row['operation'];
    }

    if (isset($_GET['period'])) {
        $filter_period = (int) $mysqli->real_escape_string($_GET['period']);
    } else {
        $filter_period = date('Y');
    }

    // World
    $filter_product_param = array(
        "Производство, тыс. т",
        "Импорт, тыс. т",
        "Экспорт, тыс. т",
        "Внутреннее потребление, тыс. т"
    );

    if ($Russia) {
        switch ($filter_operation) {
            case 'ЭК':
                $filter_product_param_titles = array(
                    "Топ-5 регионов-отправителей, тыс. т",
                    "Топ-5 стран-получателей, тыс. т"
                );
                break;
            case 'ИМ':
                $filter_product_param_titles = array(
                    "Топ-5 регионов-получателей, тыс. т",
                    "Топ-5 стран-отправителей, тыс. т"
                );
                break;
        }
    } else {

        $filter_product_param_titles = array(
            "Топ-5 стран по производству, тыс. т",
            "Топ-5 стран по импорту, тыс. т",
            "Топ-5 стран по экспорту, тыс. т",
            "Топ-5 стран по потреблению, тыс. т"
        );
    }


    ///////////// Chart DB ////////////////


    // формируем запрос в зависимости от параметра $country
    // текущий год и предыдущий
    $where_date = ' AND YEAR(delivery_date) = ' . $filter_period . '';


    if ($Russia) {

        // ///////////////// Russia ///////////////////////

        // выборка по delivery_date
        $fields   = "CAST(SUM(weight)/1000 as INTEGER) as `sum_weight`";
        $where    = " product_name = '" . $filter_product_name . "' AND product_type = '" . $filter_product_type . "' AND `operation` = '" . $filter_operation . "' AND `weight` IS NOT NULL" . $where_date;
        $group_by = " GROUP BY YEAR(`delivery_date`), MONTH(`delivery_date`)";

        $query_filter1 = "SELECT DISTINCT operation
FROM " . $table . " 
ORDER BY operation DESC 
LIMIT 1000";

        $query_filter2 = "SELECT DISTINCT product_type
FROM " . $table . " 
WHERE `operation` = '" . $filter_operation . "'
ORDER BY `product_type` DESC 
LIMIT 1000";

        $query_filter3 = "SELECT DISTINCT product_name
FROM " . $table . "
WHERE `operation` = '" . $filter_operation . "' AND `product_type` = '" . $filter_product_type . "'
ORDER BY `product_name` 
LIMIT 1000";

        $query_filter4 = "SELECT DISTINCT NULLIF(YEAR(`delivery_date`) , YEAR(DATE_ADD(CURDATE(), INTERVAL 1 YEAR)) )
FROM " . $table . " 
WHERE `operation` = '" . $filter_operation . "' AND `product_type` = '" . $filter_product_type . "' AND `product_name` = '" . $filter_product_name . "'
ORDER BY `delivery_date` 
LIMIT 1000";
    } else {
        // /////////////////////  World ////////////////////////

        $fields   = "*";
        $where    = " `product_name` = '" . $filter_product_name . "' AND `product_type` = '" . $filter_product_type . "' AND `country` = '" . $filter_country . "'";
        $group_by = "";

        $query_filter1 = "SELECT DISTINCT country
FROM " . $table . " 
ORDER BY `country` ASC 
LIMIT 1000";

        $query_filter2 = "SELECT DISTINCT product_type
FROM " . $table . "
WHERE `country` = '" . $filter_country . "'
ORDER BY `product_type` DESC 
LIMIT 1000";

        $query_filter3 = "SELECT DISTINCT product_name
FROM " . $table . "
WHERE `country` = '" . $filter_country . "' AND `product_type` = '" . $filter_product_type . "'
ORDER BY `product_name` 
LIMIT 1000";

        $query_fields = "SHOW COLUMNS FROM " . $table;
    }

    $result_filter1 = $mysqli->query($query_filter1);
    if (empty($result_filter1)) {
        echo 'Нет результатов по запросу 1';
        return;
    }
    $result_filter2 = $mysqli->query($query_filter2);
    if (empty($result_filter2)) {
        echo 'Нет результатов по запросу 2';
        return;
    }
    $result_filter3 = $mysqli->query($query_filter3);
    if (empty($result_filter3)) {
        echo 'Нет результатов по запросу 3';
        return;
    }

    if ($Russia) {
        // Russia — допольнительный фильтр
        $result_filter4 = $mysqli->query($query_filter4);
        if (empty($result_filter4)) {
            echo 'Нет результатов по запросу 4';
            return;
        }

        $query_fts = array();
        foreach (array('weight', 'price') as $key => $value) {
            $query_fts[] = "SELECT CAST(SUM(" . $value . ")/1000 as INTEGER) as `sum_" . $value . "`, YEAR(`delivery_date`) as `year`, MONTH(`delivery_date`) as `month`
        FROM `oleo_price_fts`
        WHERE `product_name` = '" . $filter_product_name . "'
        AND `product_type` = '" . $filter_product_type . "' AND `operation` = '" . $filter_operation . "' AND (YEAR(`delivery_date`) = '" . ($filter_period) . "' OR YEAR(`delivery_date`) = '" . ($filter_period - 1) . "')
        AND " . $value . " IS NOT NULL
        GROUP BY MONTH(`delivery_date`), YEAR(`delivery_date`)";
        }
    } else {
        // World — названия столбцов
        $result_fields = $mysqli->query($query_fields);
        if (empty($result_fields)) {
            echo 'Нет результатов по запросу 5';
            return;
        }
        $query = "SELECT " . $fields .
            " FROM " . $table .
            " WHERE " . $where .
            	         // " GROUP BY YEAR(`delivery_date`), MONTH(`delivery_date`)" .
            	         // " ORDER BY delivery_date" .
            $group_by .
            " LIMIT 1000";
    }


    $query_top5_chart = array();

    foreach ($filter_product_param as $key => $value) {
        if ($Russia) {
            if ($key === 0) {
                $filter_query_field = "federal_subject";
            } elseif ($key === 1) {
                $filter_query_field = "country";
            }
            $query_top5_chart[] = "SELECT CAST(SUM(weight)/1000 as INTEGER) as `sum_weight`, `" . $filter_query_field . "`
  FROM `oleo_price_fts`
  WHERE `product_name`
  = '" . $filter_product_name . "'
  AND `product_type` = '" . $filter_product_type . "' AND `operation` = '" . $filter_operation . "' AND YEAR(`delivery_date`) = '" . $filter_period . "'
  AND weight IS NOT NULL
  GROUP BY `" . $filter_query_field . "`
  ORDER BY `sum_weight` DESC
  LIMIT 5";
            $query_sum = "SELECT CAST(SUM(weight)/1000 as INTEGER) as `sum_weight`
  FROM `oleo_price_fts`
  WHERE `product_name`
  = '" . $filter_product_name . "'
  AND `product_type` = '" . $filter_product_type . "' AND `operation` = '" . $filter_operation . "' AND YEAR(`delivery_date`) = '" . $filter_period . "'
  AND weight IS NOT NULL
  ORDER BY `sum_weight` DESC";
        } else {
            $query_top5_chart[] = "SELECT *" .
                "	FROM " . $table .
                " WHERE `product_name` = '" . $filter_product_name . "' AND `product_type` = '" . $filter_product_type . "' AND `product_param` = '" . $value . "'" .
                // TODO: fix period order
                " GROUP BY `country` ORDER BY `period" . $filter_season . "` DESC" .
                " LIMIT 6";
        }
    }


    if (current_user_can('administrator')) {
        echo "<br>\n" . $query_fts[0] . "<br>";
    }

    if ($Russia) {
        $result_fts = array(); // первая ячейка массива — вес, вторая — цена; выборка: 1 текущий год
        foreach (array('weight', 'price') as $key => $value) {
            $result_fts_fields = $mysqli->query($query_fts[$key]);
            if (empty($result_fts_fields)) {
                echo 'Нет результатов по запросу 6';
                return;
            }
            $result_fts[] = $result_fts_fields;
            if ( current_user_can( 'administrator' ) ) {
//                echo $query_fts[ $key ] . "<br>\n";
            }
        }
    } else {
        $result = $mysqli->query($query);
        if (empty($result)) {
            echo 'Нет результатов по запросу 7';
            return;
        }
    }

    if ($Russia) {
        $result_top5_chart = array();
        $result_top5_sum = $mysqli->query( $query_sum );
        if (empty($result_top5_sum)) {
            echo 'Нет результатов по запросу 8';
            return;
        }
        if ( current_user_can( 'administrator' ) ) {
//            echo 'query sum:' . $query_sum;
        }
    }

    for ($i = 0; $i < count($query_top5_chart); $i++) {
        $result_top5_chart_item = $mysqli->query($query_top5_chart[$i]);
        if (empty($result_top5_chart_item)) {
            echo 'Нет результатов по запросу 9';
            return;
        }
        $result_top5_chart[] = $result_top5_chart_item;
        if ( current_user_can( 'administrator' ) ) {
//            echo $query_top5_chart[ $i ] . "<br>№№№№№№№\n";
        }
    }
//    echo 'SUM: ' . $query_sum . "<br>№№№№№№№\n";


    ////////////// PLOT THE CHART //////////////

    $date_m = array(
        'январь',
        'февраль',
        'март',
        'апрель',
        'май',
        'июнь',
        'июль',
        'август',
        'сентябрь',
        'октябрь',
        'ноябрь',
        'декабрь'
    );

    function short_month($num, $date_m = array( 'январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь' )) {
        return mb_ucfirst(mb_substr($date_m[$num - 1], 0, 3), "UTF-8");
    }


    $chart_data  = array();
    $chart_stats = array();

    if ($Russia) {
        for ($i = 0; $i < count($result_fts); $i++) {
            // 0 -- Вес; 1 -- Цена;
            if ( current_user_can( 'administrator' ) ) {
//                echo $i . "<br>\n";
            }

            $sum_param = '';

            if ($i == 0) {
                $sum_param = 'sum_weight';
            } elseif ($i == 1) {
                $sum_param = 'sum_price';
            }

            $sum_last_year = 0;
            $last_year = 0;

            $fts_data_tmp = array();

            while ($row = $result_fts[$i]->fetch_assoc()) {
                $fts_data_tmp[$i][$row['month']][$row['year']] = $row[$sum_param];

                if ( current_user_can( 'administrator' ) ) {
//                    echo $i . ': ' . $row['month'] . ' - ' . $row['year'] . ' - ' . $row[$sum_param] . "<br>\n";
                }
/*
                const chartDataFTS0 = [
{ 'month' : 'Янв', 'year1' : 6, 'year2' : 20 },
{ 'month' : 'Фев', 'year1' : 3, 'year2' : 24 },
{ 'month' : 'Апр', 'year1' : 0, 'year2' : 3 },
{ 'month' : 'Май', 'year1' : 0, 'year2' : 2 },
{ 'month' : 'Июн', 'year1' : 0, 'year2' : 2 },
{ 'month' : 'Июл', 'year1' : 0, 'year2' : 3 },
{ 'month' : 'Авг', 'year1' : 0, 'year2' : 1 },
{ 'month' : 'Сен', 'year1' : 0, 'year2' : 4 },
{ 'month' : 'Окт', 'year1' : 0, 'year2' : 10 },
{ 'month' : 'Ноя', 'year1' : 0, 'year2' : 16 },
{ 'month' : 'Дек', 'year1' : 0, 'year2' : 35 }                                    ]
*/
            }

            foreach ($fts_data_tmp[$i] as $row_month => $row_years) {
                $row_values = array_values($row_years);
                $chart_fts_data[$i][] = sprintf(
                    "{ 'month' : '%s', 'year1' : %s, 'year2' : %s }",
                    short_month($row_month),
                    $row_values[0] ?: 0,
                    $row_values[1] ?: 0
                );
            }
        }
    } else {
        // Season Fields
        $season_fields = array();

        $i = 0;
        $year = date("Y") - 10; // 2012
        while ($row = $result_fields->fetch_row()) {
            // фильтруем ненужные названия полей
            if (strpos($row[0], 'period') === 0) {
                $season_fields[] = ($year + $i) . '/' . ($year + 1 + $i);
                $i++;
            }
        }


        //   $chart_data2 = array();
        $table_rows         = '';
        $table_allowed_rows = array(
            'Начальные запасы, тыс. т',
            'Производство, тыс. т',
            'Импорт, тыс. т',
            'Всего ресурсы к распределению, тыс. т',
            'Внутреннее потребление, тыс. т',
            'Экспорт, тыс. т',
            'Конечные запасы, тыс. т'
        );
        $table_marked_rows  = array(
            'Пищевое внутреннее потребление, тыс. т',
            'Внутреннее потребление на кормовые отходы, тыс. т',
            'Промышленное внутреннее потребление, тыс. т'
        );
        $table_allowed_rows = array_merge($table_allowed_rows, $table_marked_rows);

        // Table headings

        $table_rows .= '<tr>';
        $table_rows .= '<th>Баланс, тыс. т</th>';

        foreach ($season_fields as $i => $val) {
            if ($i >= 5) { // minimum value to output
                $table_rows .= '<th>' . $val . '</th>';
            }
        }

        $table_rows .= '</tr>';


        // Table rows
        while ($row = $result->fetch_row()) {
		// echo '<pre>';print_r($row);echo '</pre>';
            $table_row_class = '';

            // gray <tr>
            if (in_array($row[3], $table_marked_rows)) {
                $table_row_class = 'text-muted';
            }
            // output only allowed rows
            if (in_array($row[3], $table_allowed_rows)) {
                $table_rows .= '<tr class="' . $table_row_class . '">';
                $table_rows .= '<td>' . str_replace(' ', '&nbsp;', str_replace(', тыс. т', '', $row[3])) . '</td>';
                for ($i = 10; $i <= 15; $i++) {  // minimum value to output
                    $table_rows .= '<td class="text-right">' . (int) $row[$i] . '</td>';
                }
            }
        } // end while
    } // end World

    for ($i = 0; $i < count($result_top5_chart); $i++) {

//        $chart_value_all    = 0;
        $chart_value_sum    = 0;
        $chart_value_others = 0;

        if ($Russia) {
            $top5_total_sum = $result_top5_sum->fetch_assoc();
        }

        while ($row = $result_top5_chart[$i]->fetch_assoc()) {
            if ($Russia) {
                // Russia
                // убираем длинные строки, чтобы график не сжимался, изменяем регистр
                $str_search = array("ГОРОД ФЕДЕРАЛЬНОГО ЗНАЧЕНИЯ", "СТОЛИЦА РОССИЙСКОЙ ФЕДЕРАЦИИ");
                if ($i === 0) : $param1 = $row['federal_subject'];
                else : $param1 = $row['country'];
                endif;
                $chart_data[$i][] = sprintf(
                    "{ 'country' : '%s', 'value' : %s }",
                    mb_convert_case(str_replace($str_search, "", $param1), MB_CASE_TITLE, "UTF-8"),
                    $row['sum_weight']
                );
                $chart_value_sum    += $row['sum_weight'];
            } else {
                // World
                $country       = $row['country'];
                $chart_stats[] = $row;


                if ($country == 'Мир') {
                    $chart_value_all = $row['period' . $filter_season];
                } else {
                    $chart_data[$i][] = sprintf("{ 'country' : '%s', 'value' : %s }", $row['country'], $row['period' . $filter_season]);
                    $chart_value_sum    += $row['period' . $filter_season];
                }
            }
        }
        if(!isset($chart_value_all)) {
          $chart_value_all = $top5_total_sum['sum_weight'];
        }
        $chart_value_others = $chart_value_all - $chart_value_sum;
//        echo $chart_value_all.'//';
        $chart_data[$i][] = sprintf("{ 'country' : '%s', 'value' : %s, 'color': '#dddddd' }", "Прочие", $chart_value_others);
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.15/amcharts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.15/serial.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.15/themes/light.js" integrity="sha256-/8ddAVEjLXcC1w4acoVN5Xpp308AmeYauva/ws3o8SE=" crossorigin="anonymous"></script>

    <!-- prices/foreign-trade-database/ -->
    <div class="chart">
        <header>
            <form id="chart-filter" action="" method="get">
                <div class="row">

                    <? if ($Russia) : ?>
                        <div class="col-md-3">
                            <label for="form-select1" class="chart-label">Направление</label>
                            <select id="form-select1" name="operation" class="chart-control" aria-label="Направление">
                                <?
                                while ($row = $result_filter1->fetch_row()) {
                                    if (!empty($row[0])) {
                                        printf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_operation == $row[0] ? 'selected' : ''), str_replace('ИМ', 'Импорт', str_replace('ЭК', 'Экспорт', $row[0])));
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="form-select2" class="chart-label">Вид продукции</label>
                            <select id="form-select2" name="type" class="chart-control" aria-label="Вид продукции">
                                <?
                                while ($row = $result_filter2->fetch_row()) {
                                    if (!empty($row[0])) {
                                        printf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_product_type == $row[0] ? 'selected' : ''), $row[0]);
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="form-select3" class="chart-label">Продукт</label>
                            <select id="form-select3" name="product" class="chart-control" aria-label="Продукт">
                                <?
                                while ($row = $result_filter3->fetch_row()) {
                                    if (!empty($row[0])) {
                                        printf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_product_name == $row[0] ? 'selected' : ''), mb_ucfirst($row[0], "UTF-8"));
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="form-select4" class="chart-label">Год</label>
                            <select id="form-select4" name="period" class="chart-control" aria-label="Год">
                                <?
                                while ($row = $result_filter4->fetch_row()) {
                                    if (!empty($row[0])) {
                                        printf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_period == $row[0] ? 'selected' : ''), $row[0]);
                                    }
                                }
                                ?>
                            </select>
                        </div>

                    <? else : ?>
                        <div class="col-md-4">
                            <label for="form-select1" class="chart-label">Страна</label>
                            <select id="form-select1" name="country" class="chart-control" aria-label="Страна">
                                <?
                                while ($row = $result_filter1->fetch_row()) {
                                    if (!empty($row[0])) {
                                        printf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_country == $row[0] ? 'selected' : ''), $row[0]);
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="form-select2" class="chart-label">Вид продукции</label>
                            <select id="form-select2" name="type" class="chart-control" aria-label="Вид продукции">
                                <?
                                while ($row = $result_filter2->fetch_row()) {
                                    if (!empty($row[0])) {
                                        printf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_product_type == $row[0] ? 'selected' : ''), $row[0]);
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="form-select3" class="chart-label">Продукт</label>
                            <select id="form-select3" name="product" class="chart-control" aria-label="Продукт">
                                <?
                                while ($row = $result_filter3->fetch_row()) {
                                    if (!empty($row[0])) {
                                        printf("<option value=\"%s\" %s>%s</option>", $row[0], ($filter_product_name == $row[0] ? 'selected' : ''), $row[0]);
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!--        <div class="col-md-12">-->
                        <!--          <p class="text-right mt-3">-->
                        <!--            <input type="submit" name="submit" value="Сформировать" class="btn btn-primary btn-sm">-->
                        <!--          </p>-->
                        <!--        </div>-->
                    <? endif; ?>

                    <? if (true) { // isset($_GET['submit'])
                    ?>

                        <? if ($Russia) : ?>

                            <?
                            if(!isset($chart_fts_data)) {
                              $max_data = 0;
                            } else {
                              $max_data = count($chart_fts_data);
                            }
                            for (
                                $i = 0;
                                $i < $max_data;
                                $i++
                            ) :
                            ?>
                                <script>
                                    const chartDataFTS<?= $i ?> = [
<?
echo join(',' . PHP_EOL, $chart_fts_data[$i]);
                                        ?>
                                    ];
                                    const chartTitle<?= $i ?> = '<?= ($i == 0) ? 'Вес, тыс. т' : 'Стоимость, млн долл.' ?>';
                                </script>
                                <div class="col-md-12">
                                    <div id="chartdiv<?= $i ?>" style="height: 500px"></div>
                                </div>
                                <script>
                                    var serialChart<?= $i ?> = AmCharts.makeChart("chartdiv<?= $i ?>", {
                                        "theme": "none",
                                        "type": "serial",
                                        "titles": [{
                                            "text": chartTitle<?= $i ?>,
                                            "size": 15,
                                            "color": "#626363",
                                            "bold": false,
                                        }, ],
                                        "legend": {
                                            "useGraphSettings": true,
                                            "align": 'center',
                                            "markerSize": 12,
                                            "valueWidth": 0,
                                            "verticalGap": 0
                                        },
                                        "dataProvider": chartDataFTS<?= $i ?>,
                                        "valueAxes": [{
                                            "unit": "",
                                            "position": "left",
                                            "title": "",
                                        }],
                                        "startDuration": 1,
                                        "graphs": [{
                                            "balloonText": "[[category]] (<?= (int) $filter_period - 1 ?>): <b>[[value]]</b>",
                                            "fillAlphas": 0.9,
                                            "lineAlpha": 0.2,
                                            "title": "<?= (int) $filter_period - 1 ?>",
                                            "type": "column",
                                            "valueField": "year1",
                                            "fillColors": '#dddddd'
                                        }, {
                                            "balloonText": "[[category]] (<?= $filter_period ?>): <b>[[value]]</b>",
                                            "fillAlphas": 0.9,
                                            "lineAlpha": 0.2,
                                            "title": "<?= $filter_period ?>",
                                            "type": "column",
                                            "valueField": "year2",
                                            "fillColors": '#7fbc2b'
                                        }],
                                        "categoryField": "month",
                                        "categoryAxis": {
                                            "gridPosition": "start"
                                        }
                                    });
                                    $('.chart-input').off().on('input change', function() {
                                        var property = jQuery(this).data('property');
                                        var target = chart;
                                        chart.startDuration = 0;

                                        if (property == 'topRadius') {
                                            target = chart.graphs[0];
                                            if (this.value == 0) {
                                                this.value = undefined;
                                            }
                                        }

                                        target[property] = this.value;
                                        chart.validateNow();
                                    });
                                </script>
                            <?
                            endfor;
                            ?>
                            <div class="col-md-12">
                                <div class="chart-product-name">Рейтинги за <?= $filter_period ?></div>
                            </div>
                        <? else : ?>
                            <div class="col-md-12">
                                <div class="table-responsive chart-table">
                                    <table class="table table-sm">
                                        <?= $table_rows ?>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="chart-product-name"><?= $filter_product_name ?>. Рейтинги</div>
                            </div>
                            <div class="col-md-4">
                                <label for="form-select1" class="chart-label">Сезон</label>
                                <select id="form-select1" name="season" class="chart-control" aria-label="Сезон">
                                    <?
                                    foreach ($season_fields as $key => $val) {
                                        printf("<option value=\"%s\" %s>%s</option>", ($key + 1), ($filter_season == ($key + 1) ? 'selected' : ''), $val);
                                    }
                                    ?>
                                </select>
                            </div>
                        <? endif; ?>


                    <? } ?>

                </div><!-- /.row -->
            </form>
            <script>
                // Init
                let formSelect = [];

                <? if ($Russia) : ?>
                    formSelect.push('<?= $filter_operation ?>');
                <? else : ?>
                    formSelect.push('<?= $filter_country ?>');
                <? endif; ?>


                formSelect.push('<?= $filter_product_type ?>');
                formSelect.push('<?= $filter_product_name ?>');

                <? if ($Russia) : ?>
                    formSelect.push('<?= $filter_period ?>');
                <? endif; ?>

                $(document).ready(function() {
                    console.log("ready! world market balances");
                    // console.log($( "#chart-filter #form-select1" ).val());
                    // console.log($( "#chart-filter #form-select2" ).val());
                    // console.log($( "#chart-filter #form-select3" ).val());
                    // $( "#chart-filter select" )
                    var matchCount = 0;
                    for (i = 0; i < formSelect.length; i++) {
                        if ($("#chart-filter #form-select" + (i + 1)).val() == formSelect[i]) {
                            matchCount++;
                            // console.log( "OKAY" );
                            // console.log(formSelect[i]);
                        }

                    }
                    if (matchCount > 0 && matchCount < formSelect.length) {
                        $('#chart-filter').submit();
                    }
                });

                $("#chart-filter select").on('change', function(e) {
                    $('#chart-filter').submit();
                });
            </script>
        </header>
        <? if (true) : // isset($_GET['submit'])
        ?>
            <div class="row">
                <? for ($i = 0; $i < count($filter_product_param_titles); $i++) : ?>
                    <div class="<?= ($Russia) ? 'col-md-12' : 'col-md-6' ?>">
                        <div class="chart-product-param-title"><?= $filter_product_param_titles[$i] ?></div>
                        <div id="chart<?= $i ?>" style="height: 300px"></div>
                    </div>
                <? endfor; ?>
            </div>
        <? endif; ?>
    </div>


    <script>
        // Chart main color
        const color = '#7fbc2b';
    </script>
    <? for ($i = 0; $i < count($filter_product_param_titles); $i++) : ?>
        <script>
            // World

            const chartData<?= $i ?> = [
                <?php echo join(',' . PHP_EOL, $chart_data[$i]) ?>
            ];

            var chart<?= $i ?> = AmCharts.makeChart("chart<?= $i ?>", {
                "hideCredits": true,
                "type": "serial",
                "theme": "none",
                "titles": [{
                    "text": '',
                    "size": 15,
                    "color": "#626363",
                    "bold": false,
                }, ],
                "dataProvider": chartData<?= $i ?>,
                "valueAxes": [{
                    "position": "top",
                    'includeAllValues': true,
                    'includeGuidesInMinMax': true

                }],
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "<span style='font-size:13px;'>[[category]]:<b>[[value]]</b></span>",
                    "title": "Вес",
                    "type": "column",
                    "fillAlphas": 0.8,

                    "valueField": "value",
                    "labelText": "[[value]]",
                    "labelFunction": function(item) {
                        return Math.abs(item.values.value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                    },
                    "fillColors": color,
                    "lineColor": color,
                    "colorField": 'color',
                    "lineColorField": 'color'
                }],
                "rotate": true,
                "categoryField": "country",
                "categoryAxis": {
                    "gridPosition": "start",
                    // "ignoreAxisWidth": true,
                    // "autoWrap": true
                }

            });
        </script>
    <? endfor; ?>
<?php
    $time_exec = '(' . round(microtime(true) - $time_start, 4) . 's ) <br>' . PHP_EOL;

    return $time_exec;
}
