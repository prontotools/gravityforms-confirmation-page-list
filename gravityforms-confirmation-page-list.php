<?php
/*
 * Plugin Name: Gravity Forms Confirmation Page List
 * Plugin URI: https://wordpress.org/plugins/gf-confirmation-page-list
 * Description: Display Confirmation Page of each Gravity Forms.
 * Version: 1.0.0
 * Author: Pronto Tools
 * Author URI: http://www.prontotools.io
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

function add_confirmation_pages_column ( $columns ) {
	$columns['confirmation_pages'] = esc_html__( 'Confirmation Pages', 'gravityforms' );

	return $columns;
}
add_filter( 'gform_form_list_columns', 'add_confirmation_pages_column' );

function show_confirmations_list_for_each_form( $form ) {
	$get_form          = GFAPI::get_form( $form->id );
	$confirmations     = $get_form['confirmations'];
	$confirmation_list = array();

	foreach ( $confirmations as $confirmation ) {
		if ( 'page' == $confirmation['type'] ) {
			$page_id        = $confirmation['pageId'];
			$page           = get_post( $page_id );
			$page_title     = $page->post_title;
			$page_permalink = get_permalink( $page_id );

			$confirmation_page_link = '<a href="' . $page_permalink . '">' . $page_title . '</a>';
			array_push( $confirmation_list, $confirmation_page_link );
		}
	}
	echo join( ', ', $confirmation_list );
}
add_action( 'gform_form_list_column_confirmation_pages', 'show_confirmations_list_for_each_form' );
