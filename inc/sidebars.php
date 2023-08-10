<?php
add_action('widgets_init', 'register_my_widgets');

function register_my_widgets() {
  register_sidebar(array(
    'name' => "Сайдбар на странице продуктов",
    'id' => "sidebar-products",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Сайдбар на странице цен",
    'id' => "sidebar-prices",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Сайдбар на странице о компании",
    'id' => "sidebar-about",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Сайдбар на странице статей",
    'id' => "sidebar-articles",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Сайдбар по умолчанию",
    'id' => "sidebar-default",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));
}
