<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OleoScope
 */

?>
	</div><!-- #content -->
  <footer class="main-footer">
    <div class="main-footer-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-2">
            <?php the_custom_logo() ?>
          </div>
          <div class="col">
            <?php
            wp_nav_menu( array(
              'theme_location' => 'menu-2',
              'container' => 'ul',
              'menu_id'        => 'footer-menu',
              'menu_class'     => 'main-footer-menu',
              'depth'          => 1,
            ) );
            ?>
          </div>
          <div class="col-md-3">
            <div class="text-right">
	            <?php
	            wp_nav_menu( array(
		            'theme_location' => 'menu-social',
		            'container' => 'ul',
		            'menu_id'        => 'social-menu-footer',
		            'menu_class'     => 'main-social',
	              'walker'         => new Social_Walker_Nav_Menu(),
//		            'link_before'    => '<i class="fab"></i>',
		            'depth'          => 1,
	            ) );
	            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p class="main-footer-legal">При использовании материалов <?php bloginfo( 'name' ); ?>.ru гиперссылка обязательна, в бумажных источниках обязательно указание ссылки на источник.<br/>Настоящий ресурс содержит материалы категории<span>18+</span></p>
            <p class="main-footer-copyright">© <?php bloginfo( 'name' ); ?> <?= date("o") ?></p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div><!-- #page -->

<a class="scroll-to-top" href="#"><? esc_html_e( 'To top', 'oleoscope' ) ?></a>

<?php wp_footer(); ?>

<?php dynamic_sidebar( 'sidebar-footer' ); ?>
</body>
</html>
