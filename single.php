<?php
global $post;

$related_tax = 'post_tag';
$related_tax_ids = wp_get_object_terms($post->ID, $related_tax, ['fields' => 'ids']);
 
$args = [
  'posts_per_page' => 5,
  'tax_query' => [
    [
      'taxonomy' => $related_tax,
      'field' => 'id',
      'include_children' => false,
      'terms' => $related_tax_ids,
      'operator' => 'IN'
    ]
  ]
];
$related_query = new WP_Query($args);
?>
<!-- <?php print_r($related_tax_ids) ?>  -->
<!-- <?php print_r($args) ?>  -->
<!-- <?php print_r($related_query) ?>  -->
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
                <?php if ($related_query->have_posts()): ?>
                <div class="details-related">
                  <div class="details-related__title">Похожие статьи по теме:</div>
                  <ul class="details-related__list">
              	    <?php while ($related_query->have_posts()): $related_query->the_post(); ?>
                    <li>
                      <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                    </li>
              	    <?php endwhile; ?>
                  </ul>
                </div>
                <?php endif; wp_reset_postdata(); ?>
              </div>
              <?php else : ?>
              Результатов не найдено
              <?php endif; ?>
            </div>
            <div class="archive-layout__right sidebar">
              <?php dynamic_sidebar('news-detail') ?>
            </div>
          </div>
        </main>
      </div>
    
      <?php get_template_part('partials/footer') ?>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
