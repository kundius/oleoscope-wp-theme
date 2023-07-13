<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OleoScope
 */

get_header();
?>
  <div class="main-page-content gray-bg">
  <!-- ARCHIVE -->
  <div class="container">
  <div class="row no-gutters flat-island">
  <div class="col-md-9">
    <div id="primary" class="content-area">
      <main id="main" class="site-main">

      <?php if ( have_posts() ) : ?>
        <div class="row">
          <div class="col-md-12">
            <header class="page-header">
              <?php
              the_archive_title( '<h1 class="page-title">', '</h1>' );
              the_archive_description( '<div class="archive-description">', '</div>' );
              ?>
            </header><!-- .page-header -->
          </div>
        </div>
        <div class="row no-gutters news-blocks">
        <?php
        /* Start the Loop */
        while ( have_posts() ) :
          the_post();

          /*
           * Include the Post-Type-specific template for the content.
           * If you want to override this in a child theme, then include a file
           * called content-___.php (where ___ is the Post Type name) and that will be used instead.
           */
        ?>
        <div class="col-md-6">
        <?php
          get_template_part( 'template-parts/content', get_post_type() );
        ?>
        </div>
        <?php
        endwhile;
        ?>
        <?php // echo do_shortcode('[ajax_load_more css_classes="myclass" post_type="' . get_post_type() . '" posts_per_page="8" transition_container_classes="row news-blocks" offset="' . get_option( 'posts_per_page' ) . '"]'); ?>
        </div>
        <?php
        the_posts_navigation();

      else :

        get_template_part( 'template-parts/content', 'none' );

      endif;
      ?>
      <?php if( function_exists('the_ad_placement') ) { the_ad_placement('after-content'); } ?>
      </main><!-- #main -->
    </div><!-- #primary -->

  </div>
    <div class="col-md-3">
      <aside id="primary" class="widget-area">
	      <?php dynamic_sidebar( 'sidebar-archive' ); ?>
      </aside>
    </div>
  </div>
  </div>
  </div>
<?php
get_footer();
