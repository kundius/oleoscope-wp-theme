<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OleoScope
 */

?>
<!-- CONTENT INTERVIEW -->
<!-- All posts and feeds except the Interview -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ( !is_singular() ) : ?>
	  <?php oleoscope_interview_thumbnail(); ?>
	<?php endif; ?>
	<header class="entry-header">
		<?php
		if ( is_singular() && in_array(get_post_type(), ['news', 'partners', 'analytics', 'interview']) ) :
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
	</header><!-- .entry-header -->


  <?php if ( is_singular() ): ?>
	<div class="entry-content">
		<?php
			 the_title( '<h1 class="entry-title">','</h1>' );
			
    if( has_excerpt() ) {
	    oleoscope_excerpt();
    }

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


		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'oleoscope' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
  <?php endif; ?>

	<footer class="entry-footer">
		<?php
	  if ( is_singular() ) :
      oleoscope_entry_footer();
    endif;
	  ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
