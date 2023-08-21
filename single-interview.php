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
              <div class="details">
                <?php if (has_post_thumbnail()): ?>
                <figure class="details__media">
                  <?php the_post_thumbnail('origin'); ?>
                </figure>
                <?php endif; ?>
                <div class="details__date"><?php echo get_the_date('d.m.Y') ?></div>
                <h1 class="details__title"><?php the_title() ?></h1>
                <div class="details__content content">
                  <?php the_content() ?>
                </div>
              </div>
              <?php else : ?>
              Результатов не найдено
              <?php endif; ?>
            </div>
            <div class="archive-layout__right sidebar">
              <?php dynamic_sidebar('interview-detail') ?>
            </div>
          </div>
        </main>
      </div>
    
      <?php get_template_part('partials/footer') ?>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
