<?php
$page = get_query_var('paged');
$thumbsize = [300, 200];

if (get_post_type() === 'interview') {
  $thumbsize = [300, 320];
}
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
          <?php dynamic_sidebar('archive-top'); ?>
          <div class="archive-layout">
            <div class="archive-layout__content">
              <?php if (have_posts()): ?>
              <?php if ($page > 1): ?>
              <div class="h1">
              <?php else: ?>
              <h1>
              <?php endif ?>
                <?php the_archive_title() ?>
              <?php if ($page > 1): ?>
              </div>
              <?php else: ?>
              </h1>
              <?php endif ?>
              <div class="archive-pagination">
                <?php simple_pagination(); ?>
              </div>
              <div class="archive-list">
                <?php while (have_posts()) : the_post(); ?>
                <div class="archive-list__item">
                  <article class="card-small">
                    <?php if (has_post_thumbnail()): ?>
                    <figure class="card-small__media">
                      <?php echo fly_get_attachment_image(get_post_thumbnail_id(), $thumbsize, true); ?>
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
              <?php dynamic_sidebar('news-list') ?>
            </div>
          </div>
        </main>
      </div>
    
      <?php get_template_part('partials/footer') ?>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
