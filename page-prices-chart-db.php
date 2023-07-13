<?php
/* Template Name: Prices Chart DB */
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


//add_filter('show_admin_bar', '__return_false');
//remove_action('wp_head', '_admin_bar_bump_cb');

get_header();

?>

  <div class="main-page-content gray-bg page-prices">
    <div class="container">
      <div class="row no-gutters flat-island">
        <div class="col-md-9">
          <div id="primary" class="content-area">
            <main id="main" class="site-main">
              <article>
                <header class="entry-header">
                    <?php the_title( '
										<h1 class="entry-title">', '</h1>' ); ?>
                </header>
                <div class="entry-content">


                    <?php
                    if ( true ) { // all users
//  if ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) || current_user_can( 'author' ) || current_user_can( 'contributor' ) ) {

//	if (isset($_GET['id'])) {
//		$stat_id = (int) $_GET['id'];
//
//	  plot_chart_db('World');
//
//	} elseif (isset($_GET['idr'])) {
//		$stat_id = (int) $_GET['idr'];
//
//	  plot_chart_db('Russia');
//	}

                        if ( basename( get_permalink() ) == 'prices-russia-database' ) {
                            plot_chart_db( 'Russia' );
                        } else {
                            plot_chart_db( 'World' );
                        }


                    } else {
                        // return 404
//	global $wp_query;
//	$wp_query->set_404();
//	status_header(404);
//	nocache_headers();
//	include( get_query_template( '404' ) );
                        echo( 'Раздел находится в разработке' );
//	return;
                    }
                    ?>
                </div>
              </article>
            </main>
          </div>
        </div>

        <div class="col-md-3">
          <aside id="primary" class="widget-area">
              <?php if ( get_the_ID() == 20 || wp_get_post_parent_id( get_the_ID() ) == 20 ) { ?>
                  <?php dynamic_sidebar( 'sidebar-page' ); ?>
              <?php } elseif ( get_the_ID() == 14 || wp_get_post_parent_id( get_the_ID() ) == 14 ) { ?>
                  <?php dynamic_sidebar( 'sidebar-prices' ); ?>
              <?php } elseif ( get_the_ID() == 25674 || wp_get_post_parent_id( get_the_ID() ) == 25674 ) { ?>
                  <?php dynamic_sidebar( 'sidebar-products' ); ?>
              <?php } ?>
          </aside>
        </div>
      </div>
    </div>
  </div>

  <div class="popup-notice">
    <div class="popup-notice__inner">
      <i class="popup-notice__button-close fas fa-times"></i>
      <div class="popup-notice__text">
        Для выгрузки базы данных требуется подписка. Пожалуйста, обратитесь к администратору.
      </div>
    </div>
  </div>

<?php
get_footer();