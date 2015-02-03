<?php
/**
 * Set, get and update our default settings so they run on activation.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Settings
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      3.1.0
 */

/**
 * Exit if accessed directly.
 *
 * @since 3.1.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Set/ get the default option values for this plugin's settings.
 *
 * @since 3.1.0
 *
 * @uses  get_option()
 */
function ddw_wcde_get_default_options() {
	
	$wcde_default_values = apply_filters(
		'wcde_filter_get_default_options',
		array(
			'wcde_german_formal'           => ( get_option( 'woocommerce_informal_localisation_type' ) ) ? get_option( 'woocommerce_informal_localisation_type' ) : 'yes',
			'wcde_loading_location'        => 'global',
			'wcde_load_extensions'         => 'yes',
			'wcde_load_string_swaps'       => 'yes',
			'wcde_load_admin_string_swaps' => 'yes'
		)  // end of array

	);  // end filter

	/** Return the settings defaults */
	return $wcde_default_values;

}  // end of function ddw_wcde_get_default_options


add_action( 'admin_init', 'ddw_wcde_update_default_options', 15 );
/**
 * Update option IDs with our default values if not existing.
 *
 * @since 3.1.0
 *
 * @uses  ddw_wcde_get_default_options()
 * @uses  get_option()
 * @uses  update_option()
 */
function ddw_wcde_update_default_options() {

	$wcde_defaults = ddw_wcde_get_default_options();

	foreach ( $wcde_defaults as $wcde_option_id => $wcde_option_value ) {

		/** If options do not exist (on first run), update them with default values */
		if ( ! get_option( $wcde_option_id ) ) {

			update_option( $wcde_option_id, $wcde_option_value );

		}  // end if

	}  // end foreach

}  // end of function ddw_wcde_update_default_options