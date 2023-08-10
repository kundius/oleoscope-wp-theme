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
  extract(shortcode_atts([], $atts));
  return load_template_part('partials/widget-feed');
}
add_shortcode('feed', 'feed_shortcode');


function directions_shortcode($atts, $content = null) {
  extract(shortcode_atts([], $atts));
  return load_template_part('partials/widget-directions');
}
add_shortcode('directions', 'directions_shortcode');


function hot_shortcode($atts, $content = null) {
  extract(shortcode_atts([], $atts));
  return load_template_part('partials/widget-hot');
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
