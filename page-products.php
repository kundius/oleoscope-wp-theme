<?php
/* 
Template Name: Products
*/

get_header();

?>

<div class="main-page-content gray-bg page-products">
	<div class="container">
		<div class="row no-gutters flat-island">
			<div class="col-md-9">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">
						
						<?php
						while ( have_posts() ) {
							the_post();
						
              get_template_part( 'template-parts/content', 'products' );
							
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						}
						
						if ( function_exists('the_ad_placement') ) { 
							the_ad_placement('after-content'); 
						}
						?>
					
					</main>					
				</div>				
			</div>
			
			<div class="col-md-3">
				<aside id="primary" class="widget-area">
          <?php dynamic_sidebar( 'sidebar-products' ); ?>
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