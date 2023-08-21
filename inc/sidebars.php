<?php
add_action('widgets_init', 'register_my_widgets');

function register_my_widgets() {
  register_sidebar(array(
    'name' => "Сайдбар на главной странице слева",
    'id' => "home-left",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Сайдбар на главной странице справа",
    'id' => "home-right",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Центр знаний список",
    'id' => "knowledge-list",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Центр знаний подробно",
    'id' => "knowledge-detail",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Цены и балансы список",
    'id' => "prices-list",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Цены и балансы подробно",
    'id' => "prices-detail",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Интервью список",
    'id' => "interview-list",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Интервью подробно",
    'id' => "interview-detail",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Новости и Аналитика список",
    'id' => "news-list",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Новости и Аналитика подробно",
    'id' => "news-detail",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Сайдбар на странице о компании",
    'id' => "about",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Сайдбар по умолчанию",
    'id' => "default",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));
}

function get_default_sidebar() {
  if (!is_page()) {
    dynamic_sidebar('default');
  }

  global $wp_query;

  if ($wp_query->post->ID === 20 || $wp_query->post->post_parent === 20) {
    dynamic_sidebar('about');
  } elseif ($wp_query->post->ID === 25674) {
    dynamic_sidebar('knowledge-list');
  } elseif ($wp_query->post->post_parent === 25680 || $wp_query->post->post_parent === 25683 || $wp_query->post->post_parent === 25674) {
    dynamic_sidebar('knowledge-detail');
  } elseif ($wp_query->post->ID === 14) {
    dynamic_sidebar('prices-list');
  } elseif ($wp_query->post->post_parent === 14) {
    dynamic_sidebar('prices-detail');
  } else {
    dynamic_sidebar('default');
  }
}
