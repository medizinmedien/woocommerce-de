<?php
/**
 * Helper functions for some string swapts (via $l10n global).
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage String Swap
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      3.0.19
 */

/**
 * Exit if accessed directly
 *
 * @since 3.0.19
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'plugins_loaded', 'ddw_wcde_do_string_swaps', 0 );
/**
 * Passing an array of labels to our helper function to do string swaps.
 *    NOTE: Most of the used strings are currently not filterable by itself.
 *          So using translations global variable and merging to the "MO" object
 *          is the only way. AND, we avoid the 'gettext' filter with that, which
 *          is by intention, and a must performance-wise!
 *
 * @since   3.0.19
 * @version 3.1.5
 *
 * @uses    get_option() To get option value.
 * @uses    wcde_is_german() To determine if in German-locale based environment.
 * @uses    ddw_wcde_custom_strings_via_l10n_global() Our own helper function, see above.
 */
function ddw_wcde_do_string_swaps() {

	/** Bail early if is not frontend or option is not set */
	if ( is_admin()
		|| 'no' === get_option( 'wcde_load_string_swaps' )
	) {

		return;

	}  // end if

	/**
	 * Helper filter, allows for custom disabling of string swaps.
	 *
	 * Usage: add_filter( 'wcde_filter_do_string_swaps', '__return_false' );
	 */
	$wcde_do_string_swaps = (bool) apply_filters( 'wcde_filter_do_string_swaps', '__return_true' );

	/**
	 * Bail early if our helper filter returns false, if we are not in German
	 *    context within WPML (premium plugin), or, if no German-based locale is
	 *    to be found for 'WPLANG'.
	 *
	 * NOTE: This is very important for multilingual sites and/or Multisite
	 *       installs.
	 */
	if ( ! $wcde_do_string_swaps || ! wcde_is_german() ) {

		return;

	}  // end if


	/**
	 * New string labels: backwards compatible with our former 'gettext' approach.
	 *
	 * NOTE I: Kept filter names from v3.0.0+ to ensure backwards compatibility!
	 *
	 * NOTE II: Both filters WON'T work for WooCommerce v2.1.6+ !
	 */
	$wcde_read_accept_string = apply_filters(
		'wcde_filter_gettext_read_accept_string',
		'Bedingungen gelesen und zur Kenntnis genommen:'
	);

	$wcde_terms_string = apply_filters(
		'wcde_filter_gettext_terms_string',
		'Liefer- und Zahlungsbedingungen (AGB)'
	);


	/**
	 * New string labels: for strings of WooCommerce v2.1.6 or onwards!
	 *
	 * @since 3.1.5
	 */
	$wcde_terms_conditions_translation = 'Bedingungen gelesen und zur Kenntnis genommen: <a href="%s" target="_blank">Liefer- und Zahlungsbedingungen (AGB)</a>';

	$wcde_terms_conditions_string = apply_filters(
		'wcde_filter_terms_conditions_string',
		$wcde_terms_conditions_translation
	);


	/** Set up our array of planned string swap keys/ strings */
	$wcde_labels = array(

		/** Read/accept string */
		'read_accept_string' => array(
			'option_key'  => 'read_accept_string',
			'strings'     => array(
				'I have read and accept the',
				'I accept the'
			),
			'translation' => esc_attr__( $wcde_read_accept_string ),
		),

		/** Terms string */
		'terms_string' => array(
			'option_key'  => 'term_string',
			'strings'     => array( 'terms &amp; conditions' ),
			'translation' => esc_attr__( $wcde_terms_string ),
		),

		/** Terms & Conditions string */
		'terms_conditions_string' => array(
			'option_key'  => 'terms_conditions_string',
			'strings'     => array( 'I&rsquo;ve read and accept the <a href="%s" target="_blank">terms &amp; conditions</a>' ),
			'translation' => $wcde_terms_conditions_string,
		)

	);  // end of array

	/** Apply our string swapper for each string or our array */
	foreach ( $wcde_labels as $wcde_label => $label_id ) {

		/** Actually load the various new label strings for display */
		ddw_wcde_custom_strings_via_l10n_global(
			$label_id[ 'option_key' ],
			(array) $label_id[ 'strings' ],
			$label_id[ 'translation' ]
		);

	}  // end foreach

}  // end of function ddw_wcde_do_string_swaps


add_action( 'admin_init', 'ddw_wcde_do_string_swaps_product_image', 15 );
/**
 * Admin string swap for "Product Image" strings (instead of "Featured Image").
 *
 * @since 3.1.1
 *
 * @uses  get_option() To get option value.
 * @uses  wcde_is_german() To determine if in German-locale based environment.
 * @uses  ddw_wcde_woocommerce_is_editing_product() To detect if editing 'product' post type.
 * @uses  ddw_wcde_custom_strings_via_l10n_global() Our own helper function, see above.
 */
function ddw_wcde_do_string_swaps_product_image() {

	/** Bail early if option is not set */
	if ( 'no' === get_option( 'wcde_load_admin_string_swaps' ) ) {

		return;

	}  // end if

	/**
	 * Helper filter, allows for custom disabling of string swaps.
	 *
	 * Usage: add_filter( 'wcde_filter_do_string_swaps', '__return_false' );
	 */
	$wcde_do_string_swaps = (bool) apply_filters( 'wcde_filter_do_string_swaps', '__return_true' );

	/**
	 * Bail early if our helper filter returns false, if we are not in German
	 *    context within WPML (premium plugin), or, if no German-based locale is
	 *    to be found for 'WPLANG'.
	 *
	 * NOTE: This is very important for multilingual sites and/or Multisite
	 *       installs.
	 */
	if ( ! $wcde_do_string_swaps || ! wcde_is_german()
		|| ! ddw_wcde_woocommerce_is_editing_product()
	) {

		return;

	}  // end if

	/** Set up our array of planned string swap keys/ strings */
	$wcde_labels = array(

		/** Featured image string */
		'featured_image_string' => array(
			'option_key'  => 'product_image_string',
			'strings'     => array( 'Featured Image' ),
			'translation' => 'Produktbild',
		),

		/** Remove featured image string */
		'remove_featured_image_string' => array(
			'option_key'  => 'remove_product_image_string',
			'strings'     => array( 'Remove featured image' ),
			'translation' => 'Produktbild entfernen',
		),

		/** Set featured image string */
		'set_featured_image_string' => array(
			'option_key'  => 'set_product_image_string',
			'strings'     => array( 'Set Featured Image', 'Set featured image' ),
			'translation' => 'Produktbild festlegen',
		)

	);  // end of array

	/** Apply our string swapper for each string or our array */
	foreach ( $wcde_labels as $wcde_label => $label_id ) {

		/** Actually load the various new label strings for display */
		ddw_wcde_custom_strings_via_l10n_global(
			$label_id[ 'option_key' ],
			(array) $label_id[ 'strings' ],
			$label_id[ 'translation' ],
			'default'
		);

	}  // end foreach

}  // end of function ddw_wcde_do_string_swaps_product_image