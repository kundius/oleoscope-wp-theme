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
  <!-- ARCHIVE INTERVIEW -->
  <div class="container">
  <div class="row no-gutters flat-island">
  <div class="col-md-9">
    <div id="primary" class="content-area">
      <main id="main" class="site-main">

      <?php if ( have_posts() ) : ?>
        <div class="row no-gutters">
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
        <!-- TODO: удалить если не понадобится -->
        <section id="interview-categories" class="widget widget_categories" style="display: none">
<!--           <h2 class="widget-title"><?= __('Key areas', 'oleoscope') ?></h2> -->
	        <?php
	        // list all categories of posts
	        $taxonomy = 'interview_categories';
	        $terms = get_terms($taxonomy); // Get all terms of a taxonomy

	        if ( $terms && !is_wp_error( $terms ) ) :
		        ?>
              <ul>
		          <?php foreach ( $terms as $term ) { ?>
                    <li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
		          <?php } ?>
<!--                 <li><a href="<?= get_post_type_archive_link('companies') ?>"><?= __('Company Profile', 'oleoscope') ?></a></li> -->
              </ul>
	        <?php
	        endif;
	        ?>
        </section>
	      <?php dynamic_sidebar( 'sidebar-interview' ); ?>
      </aside>
    </div>
  </div>
  </div>
  </div>
<?php
get_footer();
