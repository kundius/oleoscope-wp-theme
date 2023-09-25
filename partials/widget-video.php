<?php
$video_query = new WP_Query([
  'post_type' => 'news',
  'posts_per_page' => 3,
  'order' => 'DESC',
  'meta_key' => 'with_video',
  'meta_value' => '1',
  'meta_compare' => '='
]);
$video = $video_query->get_posts();
?>
<div class="video-list">
  <?php foreach ($video as $item): ?>
  <div class="video-list__item">
    <div class="card-video">
      <?php if (has_post_thumbnail($item)): ?>
      <figure class="card-video__media">
        <?php echo fly_get_attachment_image(get_post_thumbnail_id($item), [300, 200], true) ?>
      </figure>
      <?php endif ?>
      <a class="card-video__title" href="<?php the_permalink($item) ?>"><?php echo get_the_title($item) ?></a>
    </div>
  </div>
  <?php endforeach ?>
</div>
