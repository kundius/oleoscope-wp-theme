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
  <!-- PAGE -->
  <div class="container">
  <div class="row no-gutters flat-island">
  <div class="col-md-9">

    <div id="primary" class="content-area">
      <main id="main" class="site-main">

      <?php
      while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>
      <?php if( function_exists('the_ad_placement') ) { the_ad_placement('after-content'); } ?>
      </main><!-- #main -->
    </div><!-- #primary -->

  </div>
  <div class="col-md-3">
    <?php // get_sidebar() ?>
    <aside id="primary" class="widget-area">
      <?php if ( get_the_ID() == 20 || wp_get_post_parent_id( get_the_ID() ) == 20 ) { ?>
      <?php dynamic_sidebar( 'sidebar-page' ); ?>
      <?php } elseif ( get_the_ID() == 14 || wp_get_post_parent_id( get_the_ID() ) == 14 ) { ?>
      <?php dynamic_sidebar( 'sidebar-prices' ); ?>
      <?php } elseif ( get_the_ID() == 25674 || wp_get_post_parent_id( get_the_ID() ) == 25674 ) { ?>
      <?php dynamic_sidebar( 'sidebar-products' ); ?>
      <?php } ?>
    </aside><!-- #secondary -->
  </div>
  </div>
  </div>
  </div>
<?php
get_footer();
