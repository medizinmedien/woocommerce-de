<?php
/**
 * Helper function to delete plugin's options on plugin deletion.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Uninstall
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      3.1.0
 */

/**
 * Exit if accessed directly
 *
 * @since 3.1.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * If uninstall not called from WordPress, exit.
 *
 * @since 3.1.0
 *
 * @uses  WP_UNINSTALL_PLUGIN
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


/**
 * Various user checks.
 *
 * @since 3.1.0
 *
 * @uses  is_user_logged_in()
 * @uses  current_user_can()
 * @uses  wp_die()
 */
	if ( ! is_user_logged_in() ) {

		wp_die(
			__( 'You must be logged in to run this script.', 'woocommerce-german' ),
			__( 'WooCommerce German (de_DE)', 'woocommerce-german' ),
			array( 'back_link' => true )
		);

	}  // end if user login check

	if ( ! current_user_can( 'install_plugins' ) ) {

		wp_die(
			__( 'You do not have permission to run this script.', 'woocommerce-german' ),
			__( 'WooCommerce German (de_DE)', 'woocommerce-german' ),
			array( 'back_link' => true )
		);

	}  // end if user cap check


/**
 * Delete our option IDs from the database.
 *
 * @since 3.1.0
 *
 * @uses  delete_option()
 */
function ddw_wcde_delete_options() {

	$wcde_option_ids = array(
		'wcde_german_formal',
		'wcde_loading_location',
		'wcde_load_extensions',
		'wcde_load_string_swaps'
	);

	foreach ( $wcde_option_ids as $wcde_option_id ) {

		delete_option( $wcde_option_id );

	}  // end foreach

}  // end of function ddw_wcde_delete_options


/**
 * Delete our options array (settings field) from the database.
 *    Note: Respects Multisite setups and single installs.
 *
 * @since 3.1.0
 *
 * @uses  switch_to_blog()
 * @uses  restore_current_blog()
 *
 * @param array $blogs
 * @param int 	$blog
 *
 * @global $wpdb
 */
/** First, check for Multisite, if yes, delete options on a per site basis */
if ( is_multisite() ) {

	global $wpdb;

	/** Get array of Site/Blog IDs from the database */
	$blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );

	if ( $blogs ) {

		foreach ( $blogs as $blog ) {

			/** Repeat for every Site ID */
			switch_to_blog( $blog[ 'blog_id' ] );

			ddw_wcde_delete_options();

		}  // end foreach

		restore_current_blog();

	}  // end if

}

/** Otherwise, delete options from main options table */
else {

	ddw_wcde_delete_options();

}  // end if