<?php
/**
 * Translation loader for WooCommerce base plugin.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Translation Loader
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2013-2014, David Decker - DECKERWEB
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


add_action( 'plugins_loaded', 'ddw_wcde_setup_translation_loader', 0 );
/**
 * Translation loader for loading translations, depending on location
 *    (frontend & admin; frontend only; admin only). For current active plugin
 *    of WooCommerce, including the splitted strings for
 *    'woocommerce-{}' and 'woocommerce-admin-{}' files.
 *
 * @since   3.0.0
 * @version 3.1.0
 *
 * @uses    wcde_is_german() To detect German-based environemt.
 * @uses    unload_textdomain() To unload original packaged translations to avoid merging.
 * @uses    get_option() Holds preferred settings.
 * @uses    is_admin() Check if we are within admin.
 */
function ddw_wcde_setup_translation_loader() {
	
	/** Bail early, if no German locale environment */
	if ( ! wcde_is_german() ) {
		return;
	}

	/** Unload original packaged translations to avoid merging */
	//unload_textdomain( 'woocommerce' );

	/** Get plugin general options */
	$wcde_loading_location = get_option( 'wcde_loading_location' );

	/** 1) Load translations global - both, frontend & admin */
	if ( 'global' === $wcde_loading_location ) {

		add_action( 'plugins_loaded', 'ddw_wcde_do_load_translations_woocommerce' );
		//add_action( 'plugins_loaded', 'ddw_wcde_do_load_translations_woocommerce_fixes_20x' );

	}

		/** 2) Load translations only within admin */
	elseif ( is_admin() && 'admin_only' === $wcde_loading_location ) {

		add_action( 'plugins_loaded', 'ddw_wcde_do_load_translations_woocommerce' );
		//add_action( 'plugins_loaded', 'ddw_wcde_do_load_translations_woocommerce_fixes_20x' );

	}

		/** 3) Load translations only in frontend */
	elseif ( ! is_admin() && 'frontend_only' === $wcde_loading_location ) {

		add_action( 'plugins_loaded', 'ddw_wcde_do_load_translations_woocommerce' );
		//add_action( 'plugins_loaded', 'ddw_wcde_do_load_translations_woocommerce_fixes_20x' );

	}  // end if is_admin() & settings checks

}  // end of function ddw_wcde_setup_translation_loader


/**
 * Load actual translations for WooCommerce main plugin.
 *
 * @since 3.1.0
 *
 * @uses  ddw_wcde_load_custom_translations() Load the textdomain(s) for translation.
 * @uses  ddw_wcde_woocommerce_current() To detect current WooCommerce branch.
 */
function ddw_wcde_do_load_translations_woocommerce() {

	/** Admin only strings go only within admin, oh yeah! :) */
	if ( is_admin() ) {

		/** 1) Load our custom translations: WooCommerce Admin strings only! */
		ddw_wcde_load_custom_translations(
			array(
				'woocommerce',
			),
			'woocommerce-admin'
		);

	}  // end if

	/** 2) Load our custom translations: WooCommerce General/ Global */
	ddw_wcde_load_custom_translations(
		array(
			'woocommerce',
		),
		'woocommerce'
	);
	
}  // end of function ddw_wcde_do_load_translations_woocommerce


/** Following Needs to be deprecated soon... */

/**
 * Load special fixes for 'default' textdomain, only for WooCommerce 2.0.x branch.
 *
 * @since 3.1.3
 *
 * @uses  ddw_wcde_load_custom_translations() Load the textdomain(s) for translation.
 * @uses  ddw_wcde_woocommerce_current() To detect current WooCommerce branch.
 */
function ddw_wcde_do_load_translations_woocommerce_fixes_20x() {

	/** Bail early if on current branch - we only need this for old 2.0.x */
	if ( ddw_wcde_woocommerce_current() ) {
		
		return;

	}  // end if

	/** Admin only strings go only within admin, oh yeah! :) */
	if ( is_admin() ) {

		/** 1) Load our custom translations: WooCommerce Admin strings only! */
		ddw_wcde_load_custom_translations(
			array(
				'default',
			),
			'woocommerce-fixes-admin'
		);

	}  // end if

	/** 2) Load our custom translations: WooCommerce General/ Global */
	ddw_wcde_load_custom_translations(
		array(
			'default',
		),
		'woocommerce-fixes-global'
	);

}  // end of function ddw_wcde_do_load_translations_woocommerce_fixes_20x