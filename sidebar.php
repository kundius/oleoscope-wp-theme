<?php

$sidebar = get_field('sidebar');

if (empty($sidebar)) {
  $sidebar = 'default';

  if (is_category() || is_archive()) {
    $sidebar = 'articles';
  }
}

if (function_exists('dynamic_sidebar')) {
  dynamic_sidebar($sidebar);
}
