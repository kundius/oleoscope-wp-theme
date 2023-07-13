<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package OleoScope
 */

get_header();
?>
  <div class="main-page-content gray-bg">
    <!-- SEARCH -->
    <div class="container">
      <div class="row no-gutters flat-island">
        <div class="col-md-9">

          <div id="primary" class="content-area">
            <main id="main" class="site-main">


				<?php if ( have_posts() ) : ?>

                  <header class="page-header">
                    <h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'oleoscope' ), '<span>' . get_search_query() . '</span>' );
						?>
                    </h1>
                  </header><!-- .page-header -->
          <div class="search-blocks">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						?>
          <?php
						get_template_part( 'template-parts/content', 'search' );
          ?>
          <?php
					endwhile;

					the_posts_navigation();
        ?>
        </div>
        <?php
				else :
            ?>
        <div class="search-blocks">
        <?php
					get_template_part( 'template-parts/content', 'none' );
        ?>
        </div>
        <?php
				endif;
				?>


            </main><!-- #main -->
          </div><!-- #primary -->

        </div>
        <div class="col-md-3">
			  <?php get_sidebar( 'single' ) ?>
        </div>
      </div>
    </div>
  </div>
<?php
get_footer();
