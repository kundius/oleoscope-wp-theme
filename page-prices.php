<?php
/* 
Template Name: Prices 
*/

get_header();

?>

<div class="main-page-content gray-bg page-prices">
	<div class="container">
		<div class="row no-gutters flat-island">
			<div class="col-md-9">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">

						<?php
						while (have_posts()) {

							the_post();

							if (true) {
								get_template_part('template-parts/content', 'page');
							} else { ?>
								<article>
									<header class="entry-header">
										<?php the_title('
										<h1 class="entry-title">', '</h1>'); ?>
									</header>
									<!-- .entry-header -->
									<div class="alert alert-warning" role="alert">
										<?php
										printf('<p class="lead"><strong>%s</strong></p>', esc_html__('This section is visible only for our subscribers.', 'oleoscope'));
										printf('<p><a href="%s">%s.</a></p>', home_url('/about/subscription/'), esc_html__('Read more', 'oleoscope'));
										?>
									</div>
								</article>
						<?php
							}

							if (comments_open() || get_comments_number()) {
								comments_template();
							}
						}

						if (function_exists('the_ad_placement')) {
							the_ad_placement('after-content');
						}
						?>

					</main>
				</div>
			</div>

			<div class="col-md-3">
				<aside id="primary" class="widget-area">
					<?php if (get_the_ID() == 20 || wp_get_post_parent_id(get_the_ID()) == 20) { ?>
						<?php dynamic_sidebar('sidebar-page'); ?>
					<?php } elseif (get_the_ID() == 14 || wp_get_post_parent_id(get_the_ID()) == 14) { ?>
						<?php dynamic_sidebar('sidebar-prices'); ?>
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
