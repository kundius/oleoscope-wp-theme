<?php

// THEME
// \add_image_size('theme-medium', 600, 400, true);
\add_theme_support('align-wide');
\add_theme_support('responsive-embeds');
\add_theme_support('editor-styles');
\add_theme_support('wp-block-styles');
// \add_theme_support('post-thumbnails');
// \add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'script', 'style']);
\add_post_type_support('page', ['excerpt']);


// MENU
load_theme_textdomain( 'oleoscope', get_template_directory() . '/languages' );
add_theme_support('menus');
add_theme_support( 'automatic-feed-links' );
// add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1200, 9999 );
add_image_size( 'post-thumbnail', 390, 280, true );

register_nav_menus([
    'menu-1' => esc_html__( 'Primary', 'oleoscope' ),
    'menu-2' => esc_html__( 'Secondary', 'oleoscope' ),
    'menu-social' => esc_html__( 'Social', 'oleoscope' ),
]);

add_theme_support('html5', [
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
]);

// ADMIN PANEL
\add_action('admin_init', function() {
    if (isset($_GET['post'])) {
        $post_ID = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_ID = $_POST['post_ID'];
    }

    if (!isset($post_ID) || empty($post_ID)) {
        return;
    }

    // $page_template = get_post_meta($post_ID, '_wp_page_template', true);
    // if ($page_template == 'template-about.php') {
    //     remove_post_type_support('page', 'editor');
    //     remove_post_type_support('page', 'thumbnail');
    // }
    \add_shortcode('template_part', function ($atts, $content = null) {
        $tp_atts = \shortcode_atts([
            'path' =>  null,
        ], $atts);
        ob_start();
        \get_template_part($tp_atts['path']);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    });
});


// SVG
add_filter('wp_kses_allowed_html', function ($tags) {
    $tags['svg'] = [
        'xmlns' => [],
        'fill' => [],
        'viewbox' => [],
        'role' => [],
        'aria-hidden' => [],
        'focusable' => [],
        'class' => [],
    ];

    $tags['path'] = [
        'd' => [],
        'fill' => [],
    ];

    $tags['use'] = [
        'xmlns:xlink' => [],
        'xlink:href' => [],
    ];

    return $tags;
});


// SEO
\remove_action('wp_head', 'rel_canonical');
\add_action('wp_head', function () {
    if (!\is_singular()) {
        return;
    }

    $id = \get_queried_object_id();

    if (0 === $id) {
        return;
    }

    $url = \wp_get_canonical_url($id);

    if (!empty($url)) {
        echo '<link rel="canonical" itemprop="url" href="' . \esc_url($url) . '" />' . "\n";
    }
});
\add_action('wp_head', function () {
    $title = '';
    $description = '';
    $keywords = '';

    if (is_archive()) {
        $term = \get_term_by('slug', \get_query_var('term'), \get_query_var('taxonomy'));
        if ($term) {
            $title = \get_field('title', $term->taxonomy . '_' . $term->term_id);
            if (empty($title)) {
                $title = $term->name;
            }
            $description = \get_field('theme_seo_description', $term->taxonomy . '_' . $term->term_id);
            $keywords = \get_field('theme_seo_keywords', $term->taxonomy . '_' . $term->term_id);
        } elseif (\is_post_type_archive()) {
            $title = \get_queried_object()->labels->name;
        } elseif (\is_day()) {
            $title = sprintf(__('Daily Archives: %s', 'roots'), \get_the_date());
        } elseif (\is_month()) {
            $title = sprintf(__('Monthly Archives: %s', 'roots'), \get_the_date('F Y'));
        } elseif (\is_year()) {
            $title = sprintf(__('Yearly Archives: %s', 'roots'), \get_the_date('Y'));
        } elseif (\is_author()) {
            $author = \get_queried_object();
            $title = sprintf(__('Author Archives: %s', 'roots'), $author->display_name);
        } else {
            $title = \single_cat_title('', false);
        }
    } elseif (\is_search()) {
        $title = sprintf(__('Search Results for %s', 'roots'), \get_search_query());
    } elseif (\is_404()) {
        $title = 'Not Found';
    } else {
        $title = \get_field('theme_seo_title');
        if (empty($title)) {
            $title = \get_the_title();
        }
        $description = \get_field('theme_seo_description');
        $keywords = \get_field('theme_seo_keywords');
    }

    if (!empty($title)) {
        echo '<title>' . $title . '</title>';
    }

    if (!empty($keywords)) {
        echo '<meta name="keywords" content="' . $keywords . '">';
    }

    if (!empty($description)) {
        echo '<meta name="description" content="' . $description . '">';
    }
});
\add_action('acf/init', function () {
    \acf_add_local_field_group([
        'key' => 'group_theme_seo',
        'title' => 'SEO',
        'fields' => [
            [
                'key' => 'field_theme_seo_title',
                'label' => 'Заголовок',
                'name' => 'theme_seo_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_theme_seo_keywords',
                'label' => 'Ключевые слова',
                'name' => 'theme_seo_keywords',
                'type' => 'text',
            ],
            [
                'key' => 'field_theme_seo_description',
                'label' => 'Описание',
                'name' => 'theme_seo_description',
                'type' => 'textarea',
                'rows' => 3,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ],
            ],
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ],
            ],
        ],
    ]);
});


// ASSETS
add_action('wp', function () {
    $theme = wp_get_theme();

    \wp_register_style('theme-style', \get_stylesheet_uri(), [], $theme->get('Version'));
    \wp_register_script('scripts', \get_theme_file_uri('dist/scripts/bundle.js'), null, null, true);
});
add_action('wp_enqueue_scripts', function () {
    \wp_enqueue_script('scripts');
});
add_action('wp_print_styles', function () {
    \wp_enqueue_style('theme-style');
});
add_filter('stylesheet_uri', function (string $stylesheet_uri) {
    $file = 'dist/styles/bundle.css';

    if (file_exists(\get_theme_file_path($file))) {
        return \get_theme_file_uri($file);
    }

    return $stylesheet_uri;
});
// add_action('init', function () {
//     if (!\is_admin()) {
//         \wp_deregister_script('jquery');
//         \wp_register_script('jquery', false);
//     }
// });


// AJAX
\add_action('wp_enqueue_scripts', function () {
    \wp_localize_script('scripts', 'theme_ajax', [
        'url' => \admin_url('admin-ajax.php'),
    ]);
}, 99);
function get_attachment_callback() {
    $id = intval($_POST['id']);

    if (!$id) {
        echo json_encode([
            'success' => false,
        ]);

        \wp_die();
    }

    echo json_encode([
        'success' => true,
        'data' => [
            'title' => \get_the_title($id),
            'url' => \wp_get_attachment_url($id),
            'caption' => \wp_get_attachment_caption($id),
        ],
    ]);

    \wp_die();
}
\add_action('wp_ajax_get_attachment', 'get_attachment_callback');
\add_action('wp_ajax_nopriv_get_attachment', 'get_attachment_callback');


// ACF
// \acf_add_options_page(array(
//     'page_title' => 'Параметры',
//     'menu_title' => 'Параметры',
//     'menu_slug' => 'acf-options',
//     'capability' => 'edit_posts',
//     'redirect' => false,
// ));

