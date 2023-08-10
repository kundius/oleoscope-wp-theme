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
              <h1><?php the_archive_title() ?></h1>
              <div class="archive-pagination">
                <?php simple_pagination(); ?>
              </div>
              <div class="archive-list">
                <?php while (have_posts()) : the_post(); ?>
                <div class="archive-list__item">
                  <article class="card-small">
                    <?php if (has_post_thumbnail()): ?>
                    <figure class="card-small__media">
                      <?php echo fly_get_attachment_image(get_post_thumbnail_id(), [300, 200], true); ?>
                      <ul class="card-small__tags">
                        <?php $categories = get_the_category(); ?>
                        <?php if (!empty($categories)): ?>
                          <li class="card-small__tag"><?php echo esc_html($categories[0]->name) ?></li>
                        <?php endif; ?>
                      </ul>
                    </figure>
                    <?php endif; ?>
                    <a href="<?php the_permalink() ?>" class="card-small__title">
                      <?php the_title() ?>
                    </a>
                    <div class="card-small__date"><?php echo get_the_date('d.m.Y') ?></div>
                  </article>
                </div>
                <?php endwhile; ?>
              </div>
              <div class="archive-pagination">
                <?php simple_pagination(); ?>
              </div>
              <?php else : ?>
              Результатов не найдено
              <?php endif; ?>
            </div>
            <div class="archive-layout__right sidebar">
              <?php
              if (function_exists('dynamic_sidebar')) {
                dynamic_sidebar('sidebar-articles');
              }
              ?>
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
