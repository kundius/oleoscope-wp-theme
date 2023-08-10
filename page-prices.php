<?php
/* 
Template Name: Prices 
*/
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes();?> itemscope itemtype="http://schema.org/WebSite">
  <head>
    <?php get_template_part('partials/head');?>
  </head>
  <body <?php body_class() ?>>
    <?php wp_body_open() ?>

    <div class="page">
      <?php get_template_part('partials/header') ?>

      <div class="container">
        <main class="main">
          <div class="archive-layout">
            <div class="archive-layout__content">
              <?php if (have_posts()): ?>
              <h1><?php the_title() ?></h1>
              <div class="content">
                <?php the_content() ?>
              </div>
              <?php else : ?>
              Результатов не найдено
              <?php endif; ?>
            </div>
            <div class="archive-layout__right sidebar">
              <?php wp_nav_menu([
                'theme_location' => 'menu-prices',
                'container' => false,
                'menu_id' => 'menu-prices',
                'menu_class' => 'side-menu',
                'depth' => 1,
              ]); ?>
              <?php // get_template_part('partials/widget-feed') ?>
              <?php // get_template_part('partials/widget-directions') ?>
              <?php // get_template_part('partials/widget-menu-prices') ?>
              <?php // get_template_part('partials/widget-hot') ?>
              <?php // get_template_part('partials/widget-video') ?>
              <?php // get_template_part('partials/widget-subscribe') ?>
            </div>
          </div>
        </main>
      </div>
    
      <?php get_template_part('partials/footer') ?>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
