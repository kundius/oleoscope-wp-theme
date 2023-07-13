<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OleoScope
 */

if ( ! is_active_sidebar( 'sidebar-single' ) ) {
	return;
}
?>

<aside id="primary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-single' ); ?>
</aside><!-- #secondary -->
