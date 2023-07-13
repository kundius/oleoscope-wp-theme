<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OleoScope
 */

?>
<!-- CONTENT -->
<!-- All posts and feeds except the Interview -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php oleoscope_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
		if ( in_array(get_post_type(), ['news', 'interview', 'partners', 'events', 'analytics']) ) :
			?>
			<div class="entry-meta">
				<?php
				oleoscope_posted_on();
		    if ( is_singular() ) :
				  oleoscope_posted_by();
	      endif;
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
    <?php
    if ( is_singular() ) :
	    the_title( '<h1 class="entry-title">', '</h1>' );
    else :
	    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;
    ?>
	</header><!-- .entry-header -->



	<div class="entry-content">
		<?php
    if( has_excerpt() ) {
	    oleoscope_excerpt();
    }
    if ( is_singular() ) {
	    the_content( sprintf(
		    wp_kses(
		    /* translators: %s: Name of current post. Only visible to screen readers */
			    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'oleoscope' ),
			    array(
				    'span' => array(
					    'class' => array(),
				    ),
			    )
		    ),
		    get_the_title()
	    ) );
    }

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'oleoscope' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
	  if ( is_home() || is_singular() ) :
      oleoscope_entry_footer();
    endif;
	  ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
