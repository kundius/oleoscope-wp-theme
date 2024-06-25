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

  if (isset($wp_query->query_vars['paged']) && $wp_query->query_vars['paged'] > 1) {
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

  if (isset($wp_query->query_vars['paged']) && $wp_query->query_vars['paged'] > 1) {
    $text = implode(' - ', [
      'Страница ' . $wp_query->query_vars['paged'] . ' из ' . $wp_query->max_num_pages,
      get_page_name(),
      get_bloginfo('name')
    ]);
  }

  return $text;
}


add_action('admin_head', 'sitemap_news_activation');
function sitemap_news_activation() {
	if (!wp_next_scheduled('sitemap_news_hourly_event')) {
		wp_schedule_event(time(), 'hourly', 'sitemap_news_hourly_event');
	}
}

add_action('sitemap_news_hourly_event', 'do_this_hourly');
function do_this_hourly() {
  if (str_replace('-', '', get_option('gmt_offset')) < 10) {
    $tempo = '-0' . str_replace('-', '', get_option('gmt_offset'));
  } else {
    $tempo = get_option('gmt_offset');
  }
  if (strlen($tempo) == 3) {
    $tempo = $tempo . ':00';
  }
  $postsForSitemap = get_posts(array(
    'numberposts' => 100,
    'orderby' => 'modified',
    'post_type' => array('news'),
    'order' => 'DESC'
  ));
  $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
  $sitemap .= "\n" . '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
  $sitemap .= "\t" . '<url>' . "\n" .
      "\t\t" . '<loc>' . esc_url(home_url('/')) . '</loc>' .
      "\n\t\t" . '<lastmod>' . date("Y-m-d\TH:i:s", current_time('timestamp', 0)) . $tempo . '</lastmod>' .
      "\n\t\t" . '<changefreq>daily</changefreq>' .
      "\n\t\t" . '<priority>1.0</priority>' .
      "\n\t" . '</url>' . "\n";
  foreach ($postsForSitemap as $post) {
      setup_postdata( $post);
      $postdate = explode(" ", $post->post_modified);
      $sitemap .= "\t" . '<url>' . "\n" .
          "\t\t" . '<loc>' . get_permalink($post->ID) . '</loc>' .
          "\n\t\t" . '<lastmod>' . $postdate[0] . 'T' . $postdate[1] . $tempo . '</lastmod>' .
          "\n\t\t" . '<changefreq>Weekly</changefreq>' .
          "\n\t\t" . '<priority>0.5</priority>' .
          "\n\t" . '</url>' . "\n";
  }
  $sitemap .= '</urlset>';
  $fp = fopen(ABSPATH . "sitemap-news.xml", 'w');
  fwrite($fp, $sitemap);
  fclose($fp);
}
