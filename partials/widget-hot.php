<?php
$partners_query = new WP_Query([
  'post_type' => 'partners',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'orderby' => 'date',
]);
$partners = $partners_query->get_posts();
?>
<div class="widget-side">
  <div class="widget-side__title">НОВОСТИ КОМПАНИЙ</div>
  <div class="hot-list">
    <?php foreach ($partners as $item): ?>
    <div class="hot-list__item">
      <article class="card-flat">
        <a href="<?php the_permalink($item) ?>" class="card-flat__title">
          <?php echo get_the_title($item) ?>
        </a>
        <div class="card-flat__foot">
          <div class="card-flat__date"><?php echo get_the_date('d.m.Y', $item) ?></div>
          <!-- <div class="card-flat__views">1234567</div> -->
        </div>
      </article>
    </div>
    <?php endforeach; ?>
  </div>
</div>
