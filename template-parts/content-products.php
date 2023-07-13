<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OleoScope
 */

$args = array(
  'post_type' => array('page'),
  'post_parent' => get_the_ID(),
	'orderby'   => 'menu_order',
	'order' => 'ASC',
);
$query_child = new WP_Query( $args );

?>
<!-- CONTENT-PAGE -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
    <div class="products-list">
	    <?php while ($query_child->have_posts()): $query_child->the_post(); ?>
		  <a href="<?php the_permalink() ?>" class="products-item">
        <?php if ($icon = get_field('thumbnail_in_list')): ?>
          <span class="products-item__image">
						<img src="<?php echo $icon['sizes']['thumbnail'] ?>" alt="<?php the_title_attribute() ?>">
          </span>
        <?php endif; ?>
        <span class="products-item__name"><?php the_title(); ?></span>
      </a>
      <?php endwhile; wp_reset_query(); ?>
    </div>
    
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'oleoscope' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'oleoscope' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
