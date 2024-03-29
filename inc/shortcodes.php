<?php

require_once get_template_directory() . '/functions-tables.php';

function oleo_prices_func( $atts ) {
  // [oleo_prices country="all"]
  // set default values
  $defaults = array( 'country' => '' );
  $atts = shortcode_atts( $defaults, $atts );

  // return $atts['country'];
  return import_csv($atts['country']);

}
add_shortcode( 'oleo_prices', 'oleo_prices_func' );


function print_menu_shortcode($atts, $content = null) {
  extract(shortcode_atts([ 'name' => null, 'class' => null ], $atts));
  return wp_nav_menu( [
      'menu' => $name,
      'menu_class' => 'prices-menu',
      'echo' => false,
  ] );
}
add_shortcode('menu', 'print_menu_shortcode');


function feed_shortcode($atts, $content = null) {
  $defaults = array('count' => 20);
  $atts = shortcode_atts($defaults, $atts);
  
  $news_query = new WP_Query([
    'post_type' => 'news',
    'posts_per_page' => $atts['count'],
    'order' => 'DESC',
    'orderby' => 'date'
  ]);
  $news = $news_query->get_posts();

  $output = '<div class="news-feed">';
  $idx = 0;
  foreach ($news as $item) {
    $idx++;
    $output .= '<div class="news-feed__row">';
    $output .= '<article class="news-feed__item">';
    $output .= '<a href="' . get_the_permalink($item) . '" class="news-feed__title">';
    $output .= get_the_title($item);
    $output .= '</a>';
    $output .= '<div class="news-feed__date">';
    $output .= get_the_date('d.m.Y', $item);
    $output .= '</div>';
    $output .= '</article>';
    $output .= '</div>';
    if ($idx === 2) {
      $output .= '<div class="news-feed__row">';
      $output .= get_dynamic_sidebar('news-feed');
      $output .= '</div>';
    }
  }
  $output .= '</div>';
  
  return $output;
}
add_shortcode('feed', 'feed_shortcode');


function directions_shortcode($atts, $content = null) {
  extract(shortcode_atts([], $atts));
  return load_template_part('partials/widget-directions');
}
add_shortcode('directions', 'directions_shortcode');


function hot_shortcode($atts, $content = null) {
  extract(shortcode_atts([
    'date_after' => '-3 days'
  ], $atts));

  $partners_query = new WP_Query([
    'post_type' => 'news',
    'posts_per_page' => 5,
    'order' => 'DESC',
    'orderby' => 'post_views',
    'date_query' => [
      [
        'after' => $date_after,
        'column' => 'post_date',
      ],
    ],
  ]);
  $partners = $partners_query->get_posts();

  $output = '<div class="hot-list">';
  foreach ($partners as $item) {
    $output .= '<div class="hot-list__item">';
    $output .= '<article class="card-flat">';
    $output .= '<a href="'. get_the_permalink($item) . '" class="card-flat__title">';
    $output .= get_the_title($item);
    $output .= '</a>';
    $output .= '<div class="card-flat__foot">';
    $output .= '<div class="card-flat__date">' . get_the_date('d.m.Y', $item) . '</div>';
    $output .= '</div>';
    $output .= '</article>';
    $output .= '</div>';
  }
  $output .= '</div>';

  return $output;
}
add_shortcode('hot', 'hot_shortcode');


function knowledge_shortcode($atts, $content = null) {
  extract(shortcode_atts([], $atts));
  return load_template_part('partials/widget-knowledge');
}
add_shortcode('knowledge', 'knowledge_shortcode');


function subscribe_shortcode($atts, $content = null) {
  extract(shortcode_atts([], $atts));
  return load_template_part('partials/widget-subscribe');
}
add_shortcode('subscribe', 'subscribe_shortcode');


function pricesmenu_shortcode($atts, $content = null) {
  extract(shortcode_atts([], $atts));
  return load_template_part('partials/widget-menu-prices');
}
add_shortcode('pricesmenu', 'pricesmenu_shortcode');


function video_shortcode($atts, $content = null) {
  extract(shortcode_atts([], $atts));
  return load_template_part('partials/widget-video');
}
add_shortcode('video', 'video_shortcode');


function products_shortcode($atts, $content = null) {
  extract(shortcode_atts([], $atts));
  return load_template_part('partials/products');
}
add_shortcode('products', 'products_shortcode');


function plot_chart_db_shortcode($atts, $content = null) {
  $defaults = array('country' => 'World');
  $atts = shortcode_atts($defaults, $atts);
  ob_start();
  plot_chart_db($atts['country']);
  $var = ob_get_contents();
  ob_end_clean();
  return $var;
}
add_shortcode('plot_chart_db', 'plot_chart_db_shortcode');


function plot_chart_multi_shortcode($atts, $content = null) {
  $defaults = array('country' => 'World');
  $atts = shortcode_atts($defaults, $atts);
  ob_start();
  plot_chart_multi($atts['country']);
  $var = ob_get_contents();
  ob_end_clean();
  return $var;
}
add_shortcode('plot_chart_multi', 'plot_chart_multi_shortcode');


function export_csv_shortcode($atts, $content = null) {
  $defaults = array('country' => 'World');
  $atts = shortcode_atts($defaults, $atts);
  $stat_id = (int) $_GET['id'];
  ob_start();
  export_csv($stat_id, $atts['country'], 1);
  $var = ob_get_contents();
  ob_end_clean();
  return $var;
}
add_shortcode('export_csv', 'export_csv_shortcode');
