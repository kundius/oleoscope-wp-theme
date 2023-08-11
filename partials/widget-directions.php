<?php
$categories = get_categories();
?>
<div class="directions-list">
  <?php foreach($categories as $category): ?>
  <a href="<?php echo get_category_link($category->term_id) ?>" class="directions-list__item">
    <?php echo $category->name ?>
  </a>
  <?php endforeach; ?>
</div>
