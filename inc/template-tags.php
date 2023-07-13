<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package OleoScope
 */

if ( ! function_exists( 'oleoscope_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function oleoscope_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
      //Posted on
			esc_html_x( '%s', 'post date', 'oleoscope' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'oleoscope_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function oleoscope_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
      // by
			esc_html_x( '%s', 'post author', 'oleoscope' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'oleoscope_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function oleoscope_entry_footer() {
		// Hide category and tag text for pages.
    $post_types = array('post', 'news', 'interview', 'analytics', 'partners', 'events');
		if ( in_array(get_post_type(), $post_types) ) {
			/* translators: used between list items, there is a space after the comma */
//			$categories_list = get_the_category_list( esc_html__( ' ', 'oleoscope' ) ); // removed ', '
//			if ( $categories_list ) {
//				/* translators: 1: list of categories. */
//				printf( '<div class="cat-links">' . esc_html__( '%1$s', 'oleoscope' ) . '</div>', $categories_list ); // WPCS: XSS OK. // Posted in
//			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'oleoscope' ) );
			if ( is_single() && $tags_list) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links">' . __( '%1$s', 'oleoscope' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'oleoscope' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

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
	}
endif;

if ( ! function_exists( 'oleoscope_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function oleoscope_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail singular">
				<?php the_post_thumbnail(''); ?>
        <figcaption><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></figcaption>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
      <ul class="cat-labels">
      <?php
      foreach((get_the_category()) as $category) {
        echo '<li>'.$category->cat_name . '</li> ';
      }
      ?>
      </ul>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


if ( ! function_exists( 'oleoscope_interview_thumbnail' ) ) {
	
	function oleoscope_interview_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) { ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
		<?php 
		} 
		?>
		
		<div class="post-thumbnail singular">
			<?php the_post_thumbnail( 'large' ); ?>
		    <header>
		    	<div class="entry-meta">
		          	<?php
				  	if ( !is_singular() ) {
		            	oleoscope_posted_on();
						oleoscope_posted_by();
					}
		          	?>
		      	</div>
		    </header>
		    
		    <footer>
			   
			    <ul class="cat-labels">
		        	<?php echo get_the_term_list( get_the_ID(), 'interview_categories', '<li>', ',</li><li>', '</li>' ); ?>
		      	</ul>
		      
			  	<?php
			  	if ( !is_singular() ) :
			  	    the_title( '<h2 class="entry-title"><span><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></span></h2>' );
			  	endif;
			  	?>
		    </footer>
		  
		</div>
		
		<?php 
		if ( is_singular() ) { ?>
				</div>
		  	</div>
		</div><!-- .container -->
		<?php 
		} 

	}
}


if ( ! function_exists( 'oleoscope_featured_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function oleoscope_featured_thumbnail() {
		$image = null;

		if (has_post_thumbnail()) {
			// $image = (get_post_type() == 'news') ? get_the_post_thumbnail_url('large') : get_the_post_thumbnail_url();
			$image = get_the_post_thumbnail_url(get_the_ID(), 'large');
		} else {
			$thumbnail_in_list = get_field('thumbnail_in_list');
			$image = $thumbnail_in_list['sizes']['large'];
		}
		if ( post_password_required() || is_attachment() || ! $image ) {
			return;
		}
    ?>
    <?php if ( is_singular() ) : ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
    <?php endif; ?>



    <div class="post-thumbnail singular" style="background-image: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 80%, rgba(0,0,0,0) 100%), url(<?php echo $image ?>);">
				<?php // the_post_thumbnail(''); ?>
        <footer>
          <ul class="cat-labels">
          <?php // if (get_post_type() == 'news'): ?>
            <li><?= esc_html__( 'Main', 'oleoscope' ) ?></li>
          <?php // endif; ?>
          <?php
          foreach((get_the_category()) as $category) {
            echo '<li>'. $category->cat_name . '</li> ';
          }
          ?>
          </ul>
          <?php
          the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
          ?>
          <div class="entry-meta">
	          <?php
						if (in_array(get_post_type(), ['events'])) {
							if ($event_date = get_field('event_date')) {
								$time_string = '<time class="entry-date" datetime="%1$s">%2$s</time>';
								$time_string = sprintf( $time_string,
									esc_attr( wp_date(DATE_W3C, strtotime($event_date)) ),
									esc_html( wp_date('d.m.Y', strtotime($event_date)) )
								);
								$posted_on = sprintf(
									esc_html_x( '%s', 'post date', 'oleoscope' ),
									'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
								);
								echo '<span class="posted-on">' . $posted_on . '</span>';
							}
						} else {
							oleoscope_posted_on();
						}
						?>
          </div><!-- .entry-meta -->
        </footer>
      </div><!-- .post-thumbnail -->
    <?php if ( is_singular() ) : ?>
        </div>
      </div>
    </div><!-- .container -->
    <?php endif; ?>
    <?php
	}
endif;

if ( ! function_exists( 'oleoscope_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own oleoscope_excerpt() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function oleoscope_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) :
			?>
          <div class="<?php echo $class; ?>">
          <?php the_excerpt(); ?>
          </div><!-- .<?php echo $class; ?> -->
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'oleoscope_excerpt_more' ) && ! is_admin() ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
	 * a 'Continue reading' link.
	 *
	 * Create your own oleoscope_excerpt_more() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 */
	function oleoscope_excerpt_more() {
		$link = sprintf(
			'<a href="%1$s" class="more-link">%2$s</a>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'oleoscope' ), get_the_title( get_the_ID() ) )
		);
		return ' &hellip; ' . $link;
	}
	add_filter( 'excerpt_more', 'oleoscope_excerpt_more' );
endif;


/**
 * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 *
 * @param string/array $args Параметры.
 *
 * @return string HTML
 *
 * @ver 2.6.4
 */
function kama_excerpt( $args = '' ){
	global $post;

	if( is_string($args) )
		parse_str( $args, $args );

	$rg = (object) array_merge( array(
		'maxchar'   => 350,   // Макс. количество символов.
		'text'      => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
		// Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется все до <!--more--> вместе с HTML.
		'autop'     => true,  // Заменить переносы строк на <p> и <br> или нет?
		'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
		'more_text' => __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'oleoscope' ), // Текст ссылки `Читать дальше`.
	), $args );

	$rg = apply_filters( 'kama_excerpt_args', $rg );

	if( ! $rg->text )
		$rg->text = $post->post_excerpt ?: $post->post_content;

	$text = $rg->text;
	$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text ); // убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
	$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text ); // убираем шоткоды: [singlepic id=3]. Учитывает markdown
	$text = trim( $text );

	// <!--more-->
	if( strpos( $text, '<!--more-->') ){
		preg_match('/(.*)<!--more-->/s', $text, $mm );

		$text = trim( $mm[1] );

		$text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
	}
	// text, excerpt, content
	else {
		$text = trim( strip_tags($text, $rg->save_tags) );

		// Обрезаем
		if( mb_strlen($text) > $rg->maxchar ){
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text ); // убираем последнее слово, оно 99% неполное
		}
	}

	// Сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $rg->autop ){
		$text = preg_replace(
			array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
			array('',     '</p><p>',  '<br />', '</p>'),
			$text
		);
	}

	$text = apply_filters( 'kama_excerpt', $text, $rg );

	if( isset($text_append) )
		$text .= $text_append;

	return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}