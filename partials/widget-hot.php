<?php
$hot_date_after = get_field('hot_date_after', 'option');
if (empty($hot_date_after)) {
  $hot_date_after = '-3 days';
}
$partners_query = new WP_Query([
  'post_type' => 'news',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'meta_key' => 'post_views_count',
  'orderby' => 'meta_value_num',
  'date_query' => [
    [
      'after' => $hot_date_after,
      'column' => 'post_date',
    ],
  ],
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
      </div>
    </article>
  </div>
  <?php endforeach ?>
</div>
