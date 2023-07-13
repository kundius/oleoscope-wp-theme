<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OleoScope
 */

get_header();
?>
  <div class="main-page-content gray-bg">

  <div class="container">
  <div class="row no-gutters">
    <div class="col-md-12">
	  <?php
	  // set post type
	  $args = array(
		  'post_type'=>array('news'),
		  'posts_per_page'   => 0,
		  'meta_key'         => 'popular',
		  'meta_value'       => true,
	  );
	  $query = new WP_Query( $args );
    ?>
    <div class="popular-blocks d-none d-md-block">
    <?php
	  while ( $query->have_posts() ) :
		  $query->the_post();

		  ?>

		      <article class="">
            <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
            <?php oleoscope_posted_on(); ?>
          </article>

		  <?php
	    endwhile; // End of the loop.
      ?>
	  </div>
    </div>
  </div>
  <div class="row no-gutters featured-blocks d-none d-md-flex">

  <div class="col-md-9">
	  <?php
	  // set post type
	  $args = array(
		  'post_type'=>array('news'),
		  'posts_per_page'   => 5,
		  'meta_key'         => 'featured',
		  'meta_value'       => true,
	  );
	  $query = new WP_Query( $args );

    ?>
    <div class="featured-blocks-big">
    <?php
	  while ( $query->have_posts() ) :
		  $query->the_post();

		  ?>

		    <?php
		    get_template_part( 'template-parts/content', 'featured' );
		    ?>
		  <?php

		  // If comments are open or we have at least one comment, load up the comment template.
		  if ( comments_open() || get_comments_number() ) :
			  comments_template();
		  endif;

	  endwhile; // End of the loop.
	  ?>
    </div>
  </div>
  <div class="col-md-3">
	  <?php
	  // set post type
	  $args = array(
		  'post_type'=>array('page'),
		  'posts_per_page'   => 1,
			'meta_query' => array( 
					array(
							'key'   => '_wp_page_template', 
							'value' => 'page-product.php'
					)
			),
      'orderby' => 'rand',
	  );
	  $query = new WP_Query( $args );


	  while ( $query->have_posts() ) :
		  $query->the_post();

		  ?>
        <div class="">
		    <?php
		    get_template_part( 'template-parts/content', 'featured' );
		    ?>
        </div>
		  <?php

		  // If comments are open or we have at least one comment, load up the comment template.
		  if ( comments_open() || get_comments_number() ) :
			  comments_template();
		  endif;

	  endwhile; // End of the loop.
	  ?>
	  <?php
	  // set post type
	  $args = array(
		  'post_type' => array('events'),
		  'posts_per_page' => 1,
      // 'orderby' => 'rand',
	  );
	  $query = new WP_Query( $args );


	  while ( $query->have_posts() ) :
		  $query->the_post();

		  ?>
        <div class="">
		    <?php
		    get_template_part( 'template-parts/content', 'featured' );
		    ?>
        </div>
		  <?php

		  // If comments are open or we have at least one comment, load up the comment template.
		  if ( comments_open() || get_comments_number() ) :
			  comments_template();
		  endif;

	  endwhile; // End of the loop.
	  ?>
  </div>
  </div>

  <div class="row no-gutters flat-island">

  <div class="col-md-3">	 
    <?php get_sidebar('left') ?>
    <a class="read-all-posts" href="<?php echo home_url( '/news/' ) ?>">Все новости</a>
  </div>
  <div class="col-md-6">

    <div id="primary" class="content-area">
      <main id="main" class="site-main">
        <div class="row no-gutters news-blocks">
          <?php
          // set post type
          $args = array(
              'post_type'=>array('analytics'),
              'posts_per_page'   => 5,
              // exclude posts
//              'meta_query'	=> array(
//                'relation'    => 'OR',
//	              array(
//                  'key'	  	=> 'featured',
//		              'value'	  	=> 0,
//		              'compare' 	=> '=',
//	              ),
//	              array(
//		              'key'	  	=> 'featured',
//		              'compare' 	=> 'NOT EXISTS',
//	              ),
//              ),
          );
    //      get_posts($args);
          $query = new WP_Query( $args );


          while ( $query->have_posts() ) :
            $query->the_post();

	          ?>
            <div class="col-md-12">
            <?php
            get_template_part( 'template-parts/content', get_post_type() );
            ?>
            </div>
	          <?php

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
              comments_template();
            endif;

          endwhile; // End of the loop.


          get_cpt_all_items_link();
          ?>
        </div>
	      <?php if( function_exists('the_ad_placement') ) { the_ad_placement('after-content'); } ?>
      </main><!-- #main -->
    </div><!-- #primary -->

  </div>
  <div class="col-md-3">
    <?php get_sidebar() ?>
  </div>
  </div>
  </div>
  </div>
<?php
get_footer();
