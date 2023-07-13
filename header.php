<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OleoScope
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta name="cmsmagazine" content="ef9002bde22164e1bb8ca1b1793cf47b" />
	<?php seo() ?>
	<?php wp_head(); ?>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-V93S76ZTY6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-V93S76ZTY6');
</script>
	
</head>

<body <?php body_class(); ?>>
<div id="page" class="site"><!-- wrapper for mobile menu -->
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'oleoscope' ); ?></a>

  <header class="main-header">
    <div class="main-header_top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-2">
            <a class="toggler-button d-md-none" href="#main-menu"><i class="fas fa-bars"></i></a>
            <div class="main-header-logo">
              <?php the_custom_logo() ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="main-header-search d-none d-md-block">
              <?php get_search_form() ?>
            </div>
          </div>
          <div class="col-md-4">
            <div id="header-user-reg" class="main-header_top_user d-none d-md-flex">
              <div class="user-subscribe d-none d-md-block">
                <a href="<?= home_url('/about/subscription/') ?>">
                  <figure>
                    <!-- <img class="user-subscribe-image" src="<?php bloginfo( 'template_url' ); ?>/images/subscription-icon.png"/> -->
                    <div class="user-subscribe-image">
                      <i class="fas fa-tint fa-lg"></i>
                    </div>
                    <figcaption><strong>Подписаться</strong><br/>На 12 месяцев</figcaption>
                  </figure></a></div>
              <div class="user-reg">
	              <?php dynamic_sidebar( 'header' ); ?>
                <?php //echo do_shortcode("[loginform]"); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-header-bottom">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <nav class="main-nav" id="main-menu">
	            <?php
	            wp_nav_menu( array(
		            'theme_location' => 'menu-1',
	              'container'      => 'ul',
		            'menu_id'        => 'primary-menu',
//		            'menu_class'     => 'main-nav',
		            'depth'          => 2,
	            ) );
	            ?>
            </nav><!-- #site-navigation -->
          </div>
          <div class="col-md-4">
            <div class="main-header_top_mid-wrapper d-none d-md-flex">
              <div class="main-header_top_social">
                <ul>
                  <li><a href="">
                      Мы в соц. сетях
                      <i class="fas fa-share-alt"></i></a>
	                  <?php
	                  wp_nav_menu( array(
		                  'theme_location' => 'menu-social',
		                  'container' => 'ul',
		                  'menu_id'        => 'social-menu-header',
		                  'menu_class'     => 'main-social',
		                  'walker'         => new Social_Walker_Nav_Menu(),
		                  'depth'          => 1,
	                  ) );
	                  ?>
                  </li>
                </ul>
              </div>
              <div class="main-header_top_other d-none">
                <ul>
                  <li><a href="">
                      Прочее
                      <i class="fas fa-th"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header><!-- #masthead -->

	<div id="content" class="site-content">
