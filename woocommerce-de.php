<?php
/**
 * Main plugin file.
 * This plugin extends the WooCommerce shop plugin with complete German language
 *    packs - formal and informal. - WooCommerce endlich komplett auf deutsch!
 *
 * @package     WooCommerce German (de_DE)
 * @author      David Decker
 * @copyright   Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license     GPL-2.0+
 * @link        http://deckerweb.de/twitter
 *
 * @wordpress-plugin
 * Plugin Name: WooCommerce German (de_DE)
 * Plugin URI:  http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * Description: This plugin extends the WooCommerce shop plugin with complete German language packs - formal and informal. - WooCommerce endlich komplett auf deutsch!
 * Version:     3.2.0
 * Author:      David Decker - DECKERWEB
 * Author URI:  http://deckerweb.de/
 * License:     GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: woocommerce-german
 * Domain Path: /wcde-languages/
 *
 * Copyright (c) 2012-2014 David Decker - DECKERWEB
 *
 *     This file is part of WooCommerce German (de_DE),
 *     a plugin for WordPress.
 *
 *     WooCommerce German (de_DE) is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 2 of the License, or (at your option)
 *     any later version.
 *
 *     WooCommerce German (de_DE) is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Exit if accessed directly.
 *
 * @since 3.0.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Setting constants.
 *
 * @since 1.0.0
 */
/** Plugin directory */
define( 'WCDE_PLUGIN_DIR', trailingslashit( dirname( __FILE__ ) ) );

/** Set constant path to the Plugin basename (folder) */
define( 'WCDE_PLUGIN_BASEDIR', trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );

/** Define constants and set defaults for removing certain functions/ filters */
if ( ! defined( 'WCDE_LOAD_GETTEXT_FILTERS' ) ) {
	define( 'WCDE_LOAD_GETTEXT_FILTERS', FALSE );
}

if ( ! defined( 'WCDE_LOAD_STRING_SWAPS' ) ) {
	define( 'WCDE_LOAD_STRING_SWAPS', TRUE );
}

if ( ! defined( 'WCDE_LOAD_EXTENSION_SUPPORT' ) ) {
	define( 'WCDE_LOAD_EXTENSION_SUPPORT', TRUE );
}


/**
 * Set, get and update our default options.
 *
 * @since 3.1.0
 */
require_once( WCDE_PLUGIN_DIR . 'includes/wcde-settings-defaults.php' );


register_activation_hook( __FILE__, 'ddw_wcde_activation_check' );
/**
 * Checks for activated Genesis Framework before allowing plugin to activate.
 *
 * @since 3.1.0
 *
 * @uses  load_plugin_textdomain() To load plugin's default translations from plugin folder.
 */
function ddw_wcde_activation_check() {

	/** Load translations to display for the activation message. */
	load_plugin_textdomain( 'woocommerce-german', FALSE, WCDE_PLUGIN_BASEDIR . 'wcde-languages' );

	/** Set our default options so they are available immediately! */
	add_action( 'admin_init', 'ddw_wcde_update_default_options' );

}  // end of function ddw_wcde_activation_check


/**
 * Check for current WooCommerce version (branch).
 *
 * @since  3.1.0
 *
 * @return bool Returns TRUE if current WooCommerce version is at least '2.2.0',
 *              otherwise FALSE.
 */
function ddw_wcde_woocommerce_current() {

	/** Get WooCommerce version constants */
	$wc_branch = ( defined( 'WC_VERSION' ) ) ? WC_VERSION : 'foo';

	/** Check WooCommerce versions */
	if ( version_compare( $wc_branch, '2.2.0', '>=' ) ) {

		return TRUE;

	} elseif ( version_compare( $wc_branch, '2.2.0', '<' ) ) {
	//} else {
		return FALSE;

	}  // end if

}  // end of function ddw_wcde_woocommerce_current


add_action( 'init', 'ddw_wcde_init', 1 );
/**
 * Load the text domain for translation of the plugin.
 * Load admin helper functions - only within 'wp-admin'.
 * 
 * @since 1.0.0
 *
 * @uses  is_admin()
 * @uses  get_locale()
 * @uses  load_textdomain()	To load translations first from WP_LANG_DIR sub folder.
 * @uses  load_plugin_textdomain() To additionally load default translations from plugin folder (default).
 */
function ddw_wcde_init() {

	/** Load translations, plus include admin specific functions */
	if ( is_admin() ) {

		/** Set unique textdomain string */
		$wcde_textdomain = 'woocommerce-german';

		/** The 'plugin_locale' filter is also used by default in load_plugin_textdomain() */
		$locale = apply_filters( 'plugin_locale', get_locale(), $wcde_textdomain );

		/** Set filter for WordPress languages directory */
		$wcde_wp_lang_dir = apply_filters(
			'wcde_filter_wp_lang_dir',
			trailingslashit( WP_LANG_DIR ) . 'woocommerce-german/' . $wcde_textdomain . '-' . $locale . '.mo'
		);

		/** Translations: First, look in WordPress' "languages" folder = custom & update-secure! */
		if ( is_readable( $wcde_wp_lang_dir ) ) {
			load_textdomain( $wcde_textdomain, $wcde_wp_lang_dir );
		}

		/** Translations: Secondly, look in plugin's "languages" folder = default */
		load_plugin_textdomain( $wcde_textdomain, FALSE, WCDE_PLUGIN_BASEDIR . 'wcde-languages' );


		/** Include admin helper functions */
		require_once( WCDE_PLUGIN_DIR . 'includes/wcde-admin-extras.php' );

	}  // end if

	/** Add "Settings Page" link to plugin page - only within 'wp-admin' */
	if ( is_admin() && current_user_can( 'manage_woocommerce' ) ) {

		add_filter(
			'plugin_action_links_' . plugin_basename( __FILE__ ),
			'ddw_wcde_settings_page_link'
		);

	}  // end if is_admin() & cap check

	/** Include deprecated classes/ functions */
	require_once( WCDE_PLUGIN_DIR . 'includes/wcde-deprecated.php' );

}  // end of function ddw_wcde_init


add_action( 'admin_init', 'ddw_wcde_load_settings' );
/**
 * Load our plugin's settings for settings tab in WooCommerce.
 *
 * @since 3.1.0
 */
function ddw_wcde_load_settings() {

	/** Include admin helper functions */
	require_once( WCDE_PLUGIN_DIR . 'includes/wcde-settings-woocommerce.php' );

}  // end of function ddw_wcde_load_settings


/**
 * Include global needed functions.
 *
 * @since 3.0.20
 */
require_once( WCDE_PLUGIN_DIR . 'includes/wcde-functions.php' );


/**
 * Include frontend helper functions for returning other order button strings.
 *
 * @since 2.1.0
 *
 * @uses  is_admin()
 */
if ( ! is_admin() ) {

	require_once( WCDE_PLUGIN_DIR . 'includes/wcde-frontend-helpers.php' );

}  // end if is_admin() check


/**
 * Enforce "Buttonlösung" default from language pack if no filter is active.
 *
 * @since 3.0.1
 *
 * @uses  is_admin()
 * @uses  wcde_is_german() Detect German-based environment.
 * @uses  has_filter() Detects if filter in use already.
 * @uses  __wcde_order_button_kaufen() Our helper function.
 */
if ( ! is_admin() && wcde_is_german() && ! has_filter( 'woocommerce_order_button_text' ) ) {

	add_filter( 'woocommerce_order_button_text', '__wcde_order_button_kaufen' );

}  // end if is_admin(), German locale, plus filter check


/**
 * Include string swap helper functions for enforcing certain strings.
 *
 * @since 3.0.19
 *
 * @uses  WCDE_LOAD_STRING_SWAPS Our helper constant.
 * @uses  get_option()
 */
if ( ( defined( 'WCDE_LOAD_STRING_SWAPS' ) && WCDE_LOAD_STRING_SWAPS )
	&& (
		( 'yes' === get_option( 'wcde_load_string_swaps' ) )
		|| ( 'yes' === get_option( 'wcde_load_admin_string_swaps' ) )
		)
) {

	require_once( WCDE_PLUGIN_DIR . 'includes/wcde-string-swaps.php' );

}  // end if constant check


/**
 * Include the actual translation loader for WooCommerce base plugin.
 *    We do it only now, so that all preparations are loaded and available :).
 *
 * @since   3.0.0
 * @version 3.1.0
 */
require_once( WCDE_PLUGIN_DIR . 'includes/wcde-wctranslations-loader.php' );


/**
 * Include WooCommerce extensions support.
 *
 * @since 3.0.4
 *
 * @uses  WCDE_LOAD_EXTENSION_SUPPORT Our helper constant.
 * @uses  get_option()
 */
if ( ( defined( 'WCDE_LOAD_EXTENSION_SUPPORT' ) && WCDE_LOAD_EXTENSION_SUPPORT )
	&& ( 'yes' === get_option( 'wcde_load_extensions' ) )
) {

	require_once( WCDE_PLUGIN_DIR . 'includes/wcde-extensions-support.php' );

}  // end if constant check


/**
 * Returns current plugin's header data in a flexible way.
 *   Only used and loaded within '/wp-admin/'.
 *
 * @since  2.5.2
 *
 * @uses   get_plugins()
 *
 * @param  $wcde_plugin_value
 *
 * @return string String of plugin data.
 */
function ddw_wcde_plugin_get_data( $wcde_plugin_value ) {

	/** Bail early if we are not it wp-admin */
	if ( ! is_admin() ) {
		return;
	}

	/** Include WordPress plugin data */
	if ( ! function_exists( 'get_plugins' ) ) {

		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	}  // end if

	/** Get plugin folder/ file */
	$wcde_plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$wcde_plugin_file   = basename( ( __FILE__ ) );

	/** Return the value */
	return $wcde_plugin_folder[ $wcde_plugin_file ][ $wcde_plugin_value ];

}  // end of function ddw_wcde_plugin_get_data


/**
 * Include DDWPinfo library main class & file.
 *
 * @since 3.1.0
 */
if ( ! class_exists( 'DDWPinfo_Admin_Pages' )
	&& file_exists( trailingslashit( dirname( __FILE__ ) ) . 'includes/ddwpinfo/ddwpinfo.php' )
) {

	require_once( trailingslashit( dirname( __FILE__ ) ) . 'includes/ddwpinfo/ddwpinfo.php' );

}  // end if


/**
 * Special patch for "WooCommerce EU VAT Number" extension because of its code
 *    structure we have no other chance as loading here directly and without
 *    additional checks. Sadly, I hope the extension devs will fix that soon.
 *
 * @since   3.0.4
 * @version 3.1.0
 *
 * @uses    WCDE_LOAD_EXTENSION_SUPPORT Our helper constant.
 * @uses    get_option()
 * @uses    get_locale()
 * @uses    load_textdomain()
 */
if ( ( defined( 'WCDE_LOAD_EXTENSION_SUPPORT' ) && WCDE_LOAD_EXTENSION_SUPPORT )
	&& ( 'yes' === get_option( 'wcde_load_extensions' ) )
) {

	/** Set $mofile to plugin path */
	$wcde_euvat_mofile = trailingslashit( WP_PLUGIN_DIR ) . 'woocommerce-de/wc-pomo-extensions/eu-vat-number-' . get_locale() . '.mo';

	/** Finally, load the translations */
	if ( file_exists( $wcde_euvat_mofile ) ) {

		load_textdomain( 'wc_eu_vat_number', $wcde_euvat_mofile );

	}  // end if $wcde_euvat_mofile check

}  // end if constant check