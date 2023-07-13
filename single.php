<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OleoScope
 */

get_header();
?>
  <div class="main-page-content gray-bg">
  <!-- SINGLE -->
  <div class="container">
  <div class="row no-gutters flat-island">
  <div class="col-md-9">
    <div id="primary" class="content-area">
      <main id="main" class="site-main">

      <?php
      while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', get_post_type() );

        the_post_navigation();

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
	  <?php get_sidebar('single') ?>
  </div>
  </div>
  </div>
  </div>
<?php
get_footer();
