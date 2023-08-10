<?php
$news_query = new WP_Query([
  'post_type' => 'news',
  'posts_per_page' => 20,
  'order' => 'DESC',
  'orderby' => 'date'
]);
$news = $news_query->get_posts();
?>
<div class="news-feed">
  <?php foreach ($news as $item): ?>
  <div class="news-feed__row">
    <article class="news-feed__item">
      <a href="<?php the_permalink($item) ?>" class="news-feed__title">
        <?php echo get_the_title($item) ?>
      </a>
      <div class="news-feed__date"><?php echo get_the_date('d.m.Y', $item) ?></div>
    </article>
  </div>
  <?php endforeach; ?>
</div>
