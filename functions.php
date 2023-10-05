<?php

require 'inc/post-types.php';
require 'inc/pagination.php';
require 'inc/shortcodes.php';
require 'inc/sidebars.php';
require 'inc/seo.php';

function load_template_part($template_name, $part_name = null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

// THEME
// \add_image_size('theme-medium', 600, 400, true);
\add_theme_support('align-wide');
\add_theme_support('responsive-embeds');
\add_theme_support('editor-styles');
\add_theme_support('wp-block-styles');
// \add_theme_support('post-thumbnails');
// \add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'script', 'style']);
\add_post_type_support('page', ['excerpt']);
add_filter( 'widget_text', 'do_shortcode' );


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
    'menu-prices' => esc_html__( 'Prices', 'oleoscope' ),
    'menu-social' => esc_html__( 'Social', 'oleoscope' ),
    'menu-products' => esc_html__( 'Products', 'oleoscope' ),
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


// ASSETS
add_action('wp', function () {
    $theme = wp_get_theme();

    \wp_register_style('theme-style', \get_stylesheet_uri(), [], $theme->get('Version'));
    \wp_register_script('scripts', \get_theme_file_uri('dist/scripts/bundle.js'), [], $theme->get('Version'), true);
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
function add_my_options_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'Параметры',
            'menu_title' => 'Параметры',
            'menu_slug' => 'acf-options',
            'capability' => 'edit_posts',
            'redirect' => false,
        ));
    }
}
add_action( 'plugins_loaded', 'add_my_options_page' );

add_filter( 'get_the_archive_title', function( $title ){
    return preg_replace('~^[^:]+: ~', '', $title );
});


// Archives.php only shows content of type 'post', but you can alter it to include custom post types.
function namespace_add_custom_types($query) {
    if (is_category()) {
        $post_type = array(
            'nav_menu_item', 'news', 'interview', 'analytics', 'partners', 'events' // 'post'
        );
        if (get_query_var('post_type')) {
            $post_type = get_query_var('post_type');
        }
        if (isset($query->query_vars['post_type'])) {
            $post_type = $query->query_vars['post_type'];
        }
        $query->set('post_type', $post_type);
        return $query;
    }
}
add_filter('pre_get_posts', 'namespace_add_custom_types');


add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2);
function current_type_nav_class($classes, $item) {
    $post_type = get_query_var('post_type');

		if ($item->type === 'custom') {
			if ($post_type === trim($item->url, '\/')) {
				array_push($classes, 'current-menu-item');
			}
		}

    return $classes;
}

