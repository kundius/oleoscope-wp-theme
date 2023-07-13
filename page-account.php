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

  <div class="main-page-content gray-bg profile">
    <div class="container">
      <div class="row">
<!--        <div class="col-12">-->
<!--          <h2></h2>-->
<!--        </div>-->
        <div class="col-md-3 d-md-block">
          <aside class="profile-sidebar">
            <header>
	            <?php rcl_avatar(200); ?>
              <div class="cab_title d-none d-md-block">
                <h2><?php rcl_username(); ?></h2>
                <br>
                <div class="rcl-action"><?php rcl_action(); ?></div>
              </div>
            </header>
            <footer>
	            <?php do_action('rcl_area_menu'); ?>
              <!--
              <ul class="row buttons-puffs">
                <li class="col-6 col-md-6"><a href="#">
                    <figure><i class="fas fa-bell fa-lg"></i>
                      <figcaption>Уведомления</figcaption>
                    </figure></a></li>
                <li class="col-6 col-md-6 active"><a href="#">
                    <figure><i class="fas fa-cog fa-lg"></i>
                      <figcaption>Настройки</figcaption>
                    </figure></a></li>
                <li class="col-6 col-md-6"><a href="#">
                    <figure><i class="fas fa-envelope fa-lg"></i>
                      <figcaption>Сообщения</figcaption>
                    </figure></a></li>
                <li class="col-6 col-md-6"><a href="#">
                    <figure><i class="fas fa-sign-out-alt fa-lg"></i>
                      <figcaption>Выйти</figcaption>
                    </figure></a></li>
              </ul>
              -->
            </footer>
          </aside>
          <div class="profile-sidebar-link">
            <a href="<?php echo home_url('/privacy-policy/'); ?>">Политика конфиденциальности</a>
          </div>
        </div>
        <div class="col-md-9">
          <div id="primary" class="content-area">
            <main id="main" class="site-main">
              <div class="page-content">
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
              </div>
            </main>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
get_footer();
