<?php
$partners_query = new WP_Query([
  'post_type' => 'partners',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'meta_key' => 'views',
  'orderby' => 'meta_value'
]);
$partners = $partners_query->get_posts();
?>
<div class="hot-list">
  <?php foreach ($partners as $item): ?>
  <div class="hot-list__item">
    <article class="card-flat">
      <a href="<?php the_permalink($item) ?>" class="card-flat__title">
        <?php echo get_the_title($item) ?>
      </a>
      <div class="card-flat__foot">
        <div class="card-flat__date"><?php echo get_the_date('d.m.Y', $item) ?></div>
        <div class="card-flat__views"><?php echo get_post_meta(get_the_ID(), 'views', true) ?></div>
      </div>
    </article>
  </div>
  <?php endforeach; ?>
</div>
