<?php
/*
Template Name: Главная
*/
$last_interview_query = new WP_Query([
  'post_type' => 'interview',
  'posts_per_page' => 1,
  'order' => 'DESC',
  'orderby' => 'date'
]);
$last_interview = $last_interview_query->get_posts();

$last_events_query = new WP_Query([
  'post_type' => 'events',
  'posts_per_page' => 1,
  'order' => 'DESC',
  'orderby' => 'date'
]);
$last_events = $last_events_query->get_posts();

$week_news_query = new WP_Query([
  'post_type' => 'news',
  'posts_per_page' => 8,
  'order' => 'DESC',
  'orderby' => 'date',
  'meta_key' => 'featured',
  'meta_value' => '1',
  'meta_compare' => '='
]);
$week_news = $week_news_query->get_posts();

$last_analytics_query = new WP_Query([
  'post_type' => 'analytics',
  'posts_per_page' => 6,
  'order' => 'DESC',
  'orderby' => 'date',
]);
$last_analytics = $last_analytics_query->get_posts();

$categories = get_categories();
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
          <div class="nav-slider">
            <div class="swiper">
              <div class="swiper-wrapper">
                <?php foreach($categories as $category): ?>
                  <div class="swiper-slide">
                    <a href="<?php echo get_category_link($category->term_id) ?>" class="nav-slider__link">
                      <?php echo $category->name ?>
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="nav-slider-button-prev"></div>
            <div class="nav-slider-button-next"></div>
          </div>

          <?php dynamic_sidebar('banner-1'); ?>

          <div class="masthead">
            <div class="masthead__primary">
              <div class="masthead-primary">
                <div class="masthead-primary__title">Новости недели</div>
                <div class="swiper">
                  <div class="swiper-wrapper">
                    <?php foreach ($week_news as $key => $item): ?>
                    <div class="swiper-slide">
                      <div class="masthead-primary-item">
                        <div class="masthead-primary-item__image">
                          <?php echo str_replace($key === 0 ? 'loading="lazy"' : '', '', bis_get_attachment_picture(
                            get_post_thumbnail_id($item),
                            [
                              767 => [ 480, 320, 1 ],
                              9999 => [ 1024, 640, 1 ],
                            ]
                          )); ?>
                        </div>
                        <div class="masthead-primary-item__content">
                          <div class="masthead-primary-item__tags">
                            <?php $categories = get_the_category($item->ID); ?>
                            <?php if (!empty($categories)): ?>
                              <a class="masthead-primary-item__tag" href="<?php echo esc_url(get_category_link($categories[0]->term_id)) ?>"><?php echo esc_html($categories[0]->name) ?></a>
                            <?php endif; ?>
                          </div>
                          <a href="<?php the_permalink($item) ?>" class="masthead-primary-item__title">
                            <?php echo get_the_title($item) ?>
                          </a>
                          <div class="masthead-primary-item__date">
                            <?php echo get_the_date('d.m.Y', $item) ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>
            </div>
            <div class="masthead__secondary">
              <div class="masthead__secondary-cell">
                <div class="masthead-secondary">
                  <div class="masthead-secondary__title">
                    Интервью
                  </div>
                  <?php foreach ($last_interview as $item): ?>
                  <div class="masthead-secondary-item">
                    <div class="masthead-secondary-item__image">
                      <?php echo str_replace('loading="lazy"', '', bis_get_attachment_picture(
                        get_post_thumbnail_id($item),
                        [
                          767 => [ 480, 320, 1 ],
                          9999 => [ 480, 480, 1 ],
                        ]
                      )); ?>
                    </div>
                    <div class="masthead-secondary-item__content">
                      <a href="<?php the_permalink($item) ?>" class="masthead-secondary-item__title">
                        <?php echo get_the_title($item) ?>
                      </a>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="masthead__secondary-cell">
                <div class="masthead-secondary">
                  <div class="masthead-secondary__title">
                    Календарь
                  </div>
                  <?php foreach ($last_events as $item): ?>
                  <div class="masthead-secondary-item">
                    <div class="masthead-secondary-item__image">
                      <?php echo str_replace('loading="lazy"', '', bis_get_attachment_picture(
                        get_post_thumbnail_id($item),
                        [
                          767 => [ 480, 320, 1 ],
                          9999 => [ 480, 480, 1 ],
                        ]
                      )); ?>
                    </div>
                    <div class="masthead-secondary-item__content">
                      <a href="<?php the_permalink($item) ?>" class="masthead-secondary-item__title">
                        <?php echo get_the_title($item) ?>
                      </a>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="home-layout">
            <div class="home-layout__left sidebar">
              <?php dynamic_sidebar('home-left') ?>
            </div>

            <div class="home-layout__center">
              <div class="widget-side">
                <div class="widget-side__title">Аналитика</div>
                <div class="analytics-list">
                  <?php foreach ($last_analytics as $item): ?>
                  <div class="analytics-list__item">
                    <article class="card-medium">
                      <figure class="card-medium__media">
                        <?php echo bis_get_attachment_picture(
                          get_post_thumbnail_id($item),
                          [
                            767 => [  480, 320, 1 ],
                            9999 => [ 640, 480, 1 ],
                          ],
                          [
                            'class' => 'card-medium__image'
                          ]
                        ); ?>
                        <ul class="card-medium__tags">
                          <?php $categories = get_the_category($item->ID); ?>
                          <?php if (!empty($categories)): ?>
                            <li class="card-medium__tag"><?php echo esc_html($categories[0]->name) ?></li>
                          <?php endif; ?>
                        </ul>
                      </figure>
                      <div class="card-medium__date"><?php echo get_the_date('d.m.Y', $item) ?></div>
                      <a href="<?php the_permalink($item) ?>" class="card-medium__title">
                        <?php echo get_the_title($item) ?>
                      </a>
                    </article>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <div class="home-layout__right sidebar">
              <?php dynamic_sidebar('home-right') ?>
            </div>
          </div>
        </main>
      </div>

    
      <?php get_template_part('partials/footer') ?>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
