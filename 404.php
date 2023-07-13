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
<article id="post-20" class="post-20 page type-page status-publish hentry">
    <header class="entry-header">
		<h1 class="page-title">404 <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'oleoscope' ); ?></h1>
    </header><!-- .entry-header -->
    <div class="entry-content">
	<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'oleoscope' ); ?></p>


    </div><!-- .entry-content -->
    </article><!-- #post-20 -->

      <?php if( function_exists('the_ad_placement') ) { the_ad_placement('after-content'); } ?>
      </main><!-- #main -->
    </div><!-- #primary -->

  </div>
  <div class="col-md-3">
    <?php // get_sidebar() ?>
    <aside id="primary" class="widget-area">
      <?php dynamic_sidebar( 'sidebar-page' ); ?>
    </aside><!-- #secondary -->
  </div>
  </div>
  </div>
  </div>
<?php
get_footer();
