<?php

if ( ! function_exists( 'oleoscope_setup' ) ) {

	function oleoscope_setup() {

		load_theme_textdomain( 'oleoscope', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		// add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );
		add_image_size( 'post-thumbnail', 390, 280, true );

		register_nav_menus( array(
				'menu-1' => esc_html__( 'Primary', 'oleoscope' ),
				'menu-2' => esc_html__( 'Secondary', 'oleoscope' ),
				'menu-social' => esc_html__( 'Social', 'oleoscope' ),
			) );

		add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

		add_theme_support( 'custom-background', apply_filters( 'oleoscope_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
				'height'      => 43,
				'width'       => 136,
				'flex-width'  => true,
				'flex-height' => true,
			) );

	}
}
add_action( 'after_setup_theme', 'oleoscope_setup' );


function oleoscope_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'oleoscope_content_width', 640 );
}
add_action( 'after_setup_theme', 'oleoscope_content_width', 0 );


function oleoscope_widgets_init() {
	register_sidebar( array(
			'name'          => esc_html__( 'Шапка сайта', 'oleoscope' ),
			'id'            => 'header',
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',
		) );
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'oleoscope' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ) . ' Правая колонка на главной',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'oleoscope' ).' 2',
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ). ' Левая колонка на главной',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'oleoscope' ).' Фид новостей',
			'id'            => 'sidebar-archive', //feed
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'oleoscope' ).' Новость',
			'id'            => 'sidebar-single', //feed
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'oleoscope' ).' Фид интервью',
			'id'            => 'sidebar-interview', //feed
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'oleoscope' ).' Страница',
			'id'            => 'sidebar-page', //feed
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'oleoscope' ).' Цены',
			'id'            => 'sidebar-prices', //feed
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'oleoscope' ).' Продукты',
			'id'            => 'sidebar-products',
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	register_sidebar( array(
			'name'          => esc_html__( 'Футер сайта', 'oleoscope' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Add widgets here.', 'oleoscope' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',
		) );
}
add_action( 'widgets_init', 'oleoscope_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function oleoscope_scripts() {

	wp_enqueue_style( 'add_google_fonts', 'https://fonts.googleapis.com/css?family=Exo+2:600|PT+Sans:400,400i,700,700i&display=swap&subset=cyrillic', false );
	wp_enqueue_style( 'fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' );

	wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/main.min.css', null, filemtime( get_template_directory() . '/assets/main.min.css' ) );

	wp_enqueue_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );
	wp_enqueue_style( 'slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css' );
	wp_enqueue_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array( 'jquery' ), '1.9.0', true );

	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js', array(), '2.1.0', true );
	wp_enqueue_style( 'mmenu', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.2.3/mmenu.css' );
	wp_enqueue_script( 'mmenu', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.2.3/mmenu.js', array(), '8.2.3', true );

	wp_enqueue_style( 'fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', null, '3.5.7' );
	wp_enqueue_script( 'fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array(), '3.5.7', true );

	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/main.min.js', array(), filemtime( get_template_directory() . '/assets/main.min.js' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'oleoscope_scripts', 10 );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


require get_template_directory() . '/inc/post-types.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Archives.php only shows content of type 'post', but you can alter it to include custom post types.
function namespace_add_custom_types( $query ) {
	if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$query->set( 'post_type', array(
				'nav_menu_item', 'news', 'interview', 'analytics', 'partners', 'events' // 'post'
			));
		return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );


/**
 * Extend Recent Posts Widget
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */

class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

	function widget($args, $instance) {

		extract( $args );

		$title = apply_filters( 'widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);

		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'post_type' => array('news', 'analytics') ) ) );
		if ( $r->have_posts() ) :

			echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title; ?>
			<ul>
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li>
						<p><span><?php the_category(', '); ?></span> <a href="<?php the_permalink(); ?>"><span><?php echo get_the_date( ''); ?></span></a></p>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

					</li>
				<?php endwhile; ?>
			</ul>

			<?php
		echo $after_widget;

		wp_reset_postdata();

		endif;
	}
}


function my_recent_widget_registration() {
	unregister_widget('WP_Widget_Recent_Posts');
	register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');

// Social Menu Walker


class Social_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Starts the element output.
	 *
	 * @since 3.0.0
	 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output Passed by reference. Used to append additional content.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$link_class = $classes[0];
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		// создаем HTML код элемента меню
		$output .= $indent . '<li' . $id . '>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . ' title="' . $title . '">';
		$item_output .= '<i class="fab ' . $link_class. '"></i>';
		$item_output .= $args->link_before .  $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

}

// get custom post type labels (all_items)
function get_cpt_all_items_link() {
	function cpt_get_labels() {
		$post_type_name = get_post_type();
		$post_type_obj  = get_post_type_object( $post_type_name );

		return $post_type_obj;
	}

	$labels = cpt_get_labels();
	$labels = $labels->labels;
	$result = get_object_vars( $labels )['all_items'];
	printf( '<a class="read-all-posts" href="%s">%s</a>', get_post_type_archive_link( get_post_type() ), $result);
}

if ( current_user_can( 'manage_options' ) ) {
	show_admin_bar( true );
}

// Ad label

// add "ad" headline before ads

function my_advanced_ads_headline( $output, $ad ) {
	// check if this is an AdSense ad
	// if( $ad->type !== 'adsense' ){
	//  return $output;
	// }

	$headline = sprintf(esc_html__('Advertising on %s', 'oleoscope'), get_bloginfo( 'name' ));
	$ads_label = '<p class="text-center"><small><a href="'.get_permalink(26).'"> ' . $headline . '</a></small></p>';

	$output = str_replace('</a>', '</a>' . $ads_label, $output);
	return $output;
}
add_action( 'advanced-ads-output-final', 'my_advanced_ads_headline', 10, 2 );


// Import CSV module
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



// Import CSV module 2

//function oleo_prices_db_func( $atts ) {
//	// [oleo_prices country="all"]
//	// set default values
//	$defaults = array( 'country' => '' );
//	$atts = shortcode_atts( $defaults, $atts );
//
//	return import_csv_db($atts['country']);
//
//}
//add_shortcode( 'oleo_prices_db', 'oleo_prices_db_func' );



function print_menu_shortcode($atts, $content = null) {
	extract(shortcode_atts([ 'name' => null, 'class' => null ], $atts));
	return wp_nav_menu( [
	    'menu' => $name,
      'menu_class' => 'prices-menu',
      'echo' => false,
  ] );
}

add_shortcode('menu', 'print_menu_shortcode');


function seo () {
  $title = '';
  $description = '';
  $keywords = '';

  if (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      $title = get_field('seo_title', $term->taxonomy . '_' . $term->term_id);
      if (empty($title)) {
        $title = $term->name;
      }
      $description = get_field('seo_description', $term->taxonomy . '_' . $term->term_id);
      $keywords = get_field('seo_keywords', $term->taxonomy . '_' . $term->term_id);
    } elseif (is_post_type_archive()) {
      $title = get_queried_object()->labels->name;
    } elseif (is_day()) {
      $title = sprintf(__('Daily Archives: %s', 'roots'), get_the_date());
    } elseif (is_month()) {
      $title = sprintf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
    } elseif (is_year()) {
      $title = sprintf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
    } elseif (is_author()) {
      $author = get_queried_object();
      $title = sprintf(__('Author Archives: %s', 'roots'), $author->display_name);
    } else {
      $title = single_cat_title('', false);
    }
  } elseif (is_search()) {
    $title = sprintf(__('Search Results for %s', 'roots'), get_search_query());
  } elseif (is_404()) {
    $title = 'Not Found';
  } else {
    $title = get_field('seo_title');
    if (empty($title)) {
      $title = get_the_title();
    }
    $description = get_field('seo_description');
    $keywords = get_field('seo_keywords');
  }

  echo '<title>' . $title . '</title>';
  if (!empty($keywords)) {
    echo '<meta name="keywords" content="' . $keywords . '">';
  }
  if (!empty($description)) {
    echo '<meta name="description" content="' . $description . '">';
  }
}

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
