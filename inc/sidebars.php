<?php
add_action('widgets_init', 'register_my_widgets');

function register_my_widgets() {
  register_sidebar(array(
    'name' => "Сайдбар на странице продуктов",
    'id' => "products",
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget-side %2$s">',
    'after_widget' => "</div>\n",
    'before_title' => '<div class="widget-side__title">',
    'after_title' => "</div>\n",
  ));

  register_sidebar(array(
    'name' => "Сайдбар на странице цен",
    'id' => "prices",
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
    'name' => "Сайдбар на странице статей",
    'id' => "articles",
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
