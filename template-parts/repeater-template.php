<div class="col-md-6">
	<article <?php post_class(); ?> <?php if (!has_post_thumbnail()) { ?> class="no-img"<?php } ?>>
		<?php if ( has_post_thumbnail() ) { oleoscope_post_thumbnail('alm-thumbnail'); }?>
		<header class="entry-header">
			<div class="entry-meta">
				<?php
				oleoscope_posted_on();
				if ( is_singular() ) :
					oleoscope_posted_by();
				endif;
				?>
			</div><!-- .entry-meta -->
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			if( has_excerpt() ) {
				oleoscope_excerpt();
			}
			?>
		</div><!-- .entry-content -->
	</article>
</div>