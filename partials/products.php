<?php
$args = array(
  'post_type' => array('page'),
  'post_parent' => get_the_ID(),
  'orderby'   => 'menu_order',
  'order' => 'ASC',
);
$query_child = new WP_Query( $args );
?>
<div class="products-list">
  <?php while ($query_child->have_posts()): $query_child->the_post(); ?>
  <a href="<?php the_permalink() ?>" class="products-item">
    <?php if (has_post_thumbnail()): ?>
    <span class="products-item__image">
      <?php echo fly_get_attachment_image(get_post_thumbnail_id(), [100, 100], true); ?>
    </span>
    <?php endif; ?>
    <span class="products-item__name"><?php the_title(); ?></span>
  </a>
  <?php endwhile; wp_reset_query(); ?>
</div>
