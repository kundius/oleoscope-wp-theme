<?php

function get_page_name() {
  if (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      return $term->name;
    } elseif (is_post_type_archive()) {
      return get_queried_object()->labels->name;
    } elseif (is_day()) {
      return sprintf(__('Daily Archives: %s', 'roots'), get_the_date());
    } elseif (is_month()) {
      return sprintf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
    } elseif (is_year()) {
      return sprintf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
    } elseif (is_author()) {
      $author = get_queried_object();
      return sprintf(__('Author Archives: %s', 'roots'), $author->display_name);
    } else {
      return single_cat_title('', false);
    }
  } elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'roots'), get_search_query());
  } elseif (is_404()) {
    return 'Not Found';
  } else {
    return get_the_title();
  }
}

remove_action('wp_head', 'rel_canonical');

add_filter('aioseo_title', 'ats_custom_aioseo_title');
function ats_custom_aioseo_title($text) {
  global $wp_query;

  if ($wp_query->query_vars['paged'] > 1) {
    $text = implode(' - ', [
      'Страница ' . $wp_query->query_vars['paged'] . ' из ' . $wp_query->max_num_pages,
      get_page_name(),
      get_bloginfo('name')
    ]);
  }

  return $text;
}

add_filter('aioseo_description', 'ats_custom_aioseo_description');
function ats_custom_aioseo_description($text) {
  global $wp_query;

  if ($wp_query->query_vars['paged'] > 1) {
    $text = implode(' - ', [
      'Страница ' . $wp_query->query_vars['paged'] . ' из ' . $wp_query->max_num_pages,
      get_page_name(),
      get_bloginfo('name')
    ]);
  }

  return $text;
}
