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
              <h1>Результаты по запросу:</h1>
              
              <form role="search" id="searchform" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
                  <input type="search" class="searchform__control" placeholder="<?php echo esc_attr_x( 'Найти на сайте …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                  <button class="searchform__submit"></button>
              </form>

              <div class="archive-pagination">
                <?php simple_pagination() ?>
              </div>
              <div class="archive-list">
                <?php while (have_posts()): the_post(); ?>
                <div class="archive-list__item">
                  <article class="card-small">
                    <?php if (has_post_thumbnail()): ?>
                    <figure class="card-small__media">
                      <?php echo fly_get_attachment_image(get_post_thumbnail_id(), [300, 200], true) ?>
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
                <?php simple_pagination() ?>
              </div>
              <?php else: ?>
              Результатов не найдено
              <?php endif; ?>
            </div>
            <div class="archive-layout__right sidebar">
              <?php get_default_sidebar() ?>
            </div>
          </div>
        </main>
      </div>
    
      <?php get_template_part('partials/footer') ?>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
