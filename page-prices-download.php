<?php
/* Template Name: Prices Download */
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OleoScope
 */

if ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) || current_user_can( 'author' ) || current_user_can( 'contributor' ) ) {

    if ( isset( $_GET['dl'] ) ) {
        $stat_id = (int) $_GET['dl'];

        export_csv( $stat_id, 'World' );

    } elseif ( isset( $_GET['dlr'] ) ) {
        $stat_id = (int) $_GET['dlr'];

        export_csv( $stat_id, 'Russia' );
    }

} else {
    // return 404
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    nocache_headers();
    include( get_query_template( '404' ) );

    return;
}