<?php
/* 
Template Name: Products
*/

$args = array(
  'post_type' => array('page'),
  'post_parent' => get_the_ID(),
  'orderby'   => 'menu_order',
  'order' => 'ASC',
);
$query_child = new WP_Query( $args );
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
              <div class="products-list">
                <?php while ($query_child->have_posts()): $query_child->the_post(); ?>
                <a href="<?php the_permalink() ?>" class="products-item">
                  <?php if ($icon = get_field('thumbnail_in_list')): ?>
                    <span class="products-item__image">
                      <img src="<?php echo $icon['sizes']['thumbnail'] ?>" alt="<?php the_title_attribute() ?>">
                    </span>
                  <?php endif; ?>
                  <span class="products-item__name"><?php the_title(); ?></span>
                </a>
                <?php endwhile; wp_reset_query(); ?>
              </div>
              <div class="content">
                <?php the_content() ?>
              </div>
              <?php else : ?>
              Результатов не найдено
              <?php endif; ?>
            </div>
            <div class="archive-layout__right sidebar">
              <?php
              if (function_exists('dynamic_sidebar')) {
                dynamic_sidebar('sidebar-products');
              }
              ?>
              <?php wp_nav_menu([
                'theme_location' => 'menu-products',
                'container' => false,
                'menu_id' => 'menu-products',
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
