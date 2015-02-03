<?php
/**
 * Global needed functions.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Functions
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2013-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      3.0.20
 */

/**
 * Exit if accessed directly
 *
 * @since 3.0.20
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Helper function to determine if in a German locale based environment.
 *
 * @since  3.0.20
 *
 * @uses   get_option()
 * @uses   get_site_option()
 * @uses   get_locale()
 * @uses   ICL_LANGUAGE_CODE Constant of WPML premium plugin, if defined.
 *
 * @return bool If German-based locale, return TRUE, otherwise FALSE.
 */
function wcde_is_german() {

	/** Set array of German-based locale codes */
	$german_locales = array( 'de_DE', 'de_AT', 'de_CH', 'de_LU', 'gsw' );

	/** Get possible WPLANG option values */
	$option_wplang      = get_option( 'WPLANG' );
	$site_option_wplang = get_site_option( 'WPLANG' );

	/**
	 * Check for German-based environment/ context in locale/ WPLANG setting
	 *    and/ or within WPML (premium plugin).
	 *
	 * NOTE: This is very important for multilingual sites and/or Multisite
	 *       installs.
	 */
	if ( ( in_array( get_locale(), $german_locales )
					|| ( $option_wplang && in_array( $option_wplang, $german_locales ) )
					|| ( $site_option_wplang && in_array( $site_option_wplang, $german_locales ) )
			)
			|| ( defined( 'ICL_LANGUAGE_CODE' ) && ( 'de' === ICL_LANGUAGE_CODE ) )
	) {

		/** Yes, we are in German-based environmet */
		return TRUE;

	} else {

		/** Non-German! */
		return FALSE;

	}  // end if

}  // end of function wcde_is_german


/**
 * Detects WooCommerce settings and returns TRUE or FALSE.
 *
 * @since  3.0.2
 *
 * @uses   get_option()
 *
 * @return boolean TRUE if informal translations should be loaded, FALSE if not.
 */
function ddw_wcde_woocommerce_is_informal() {
	
	/** Get the option from WooCommerce settings */
	$wcde_lang_type = ( 'no' === get_option( 'wcde_german_formal' ) ) ? TRUE : FALSE;

	/** Return TRUE or FALSE based on setting */
	return $wcde_lang_type;

}  // end of function ddw_wcde_woocommerce_is_informal


/**
 * Helper function for checking supported plugins by checking against unique
 *    classes, constants or functions.
 *
 * @since  3.1.0
 *
 * @param  string $identifier Name of a unique class, constant or function.
 *
 * @return bool TRUE if class/ constant/ function exists, otherwise FALSE.
 */
function ddw_wcde_unique_plugin_check( $identifier ) {
	
	$output = 'default';

	/** Check any unique class name */
	if ( class_exists( esc_attr( $identifier ) ) ) {

		$output = TRUE;

	}

		/** Check any unique constant name */
	elseif ( defined( esc_attr( $identifier ) ) ) {

		$output = TRUE;

	}

		/** Check any unique function name */
	elseif ( function_exists( esc_attr( $identifier ) ) ) {

		$output = TRUE;

	}  // end if

	/** Return the function */
	return $output;

}  // end of function ddw_wcde_unique_plugin_check


/**
 * Get the Blog/ Site upload location location for URL or path, and for
 *    Multisite or not.
 *
 * Takes account of multisite usage, and domain mapping.
 *
 * @author StudioPress
 * @link   http://www.studiopress.com/
 * @author David Decker - DECKERWEB
 * @link   http://deckerweb.de/twitter
 *
 * @since  3.1.0
 *
 * @uses   wp_upload_dir()
 *
 * @param  string $type Either 'url' or anything else e.g. 'path'.
 *
 * @return string String of path or URL of WordPress upload directory.
 */
function ddw_wcde_get_site_upload_location( $type ) {

	/** Get the uploads directory -- supports Multisite of course */
	$uploads = wp_upload_dir();
	$dir     = ( 'url' == $type ) ? $uploads[ 'baseurl' ] : $uploads[ 'basedir' ];

	/** Return Blog/ Site upload location */
	return apply_filters( 'wcde_filter_get_site_upload_location', $dir . '/' );

}  // end of function ddw_wcde_get_site_upload_location


/**
 * Loading logic for (various) textdomains, based on different locations of the
 *    language files.
 *
 * @since  3.1.0
 *
 * @uses   get_locale() Get WPLANG locale string.
 * @uses   ddw_wcde_woocommerce_is_informal() Holds setting for preferred language variant.
 * @uses   WP_LANG_DIR Defined global language location/ folder.
 * @uses   ddw_wcde_get_site_upload_location() Helps determine the path/URL string for upload location.
 * @uses   WP_PLUGIN_DIR Defined global plugin location/ folder.
 * @uses   load_textdomain() Loads translation file for a given textdomain.
 *
 * @param  array $textdomains Array of used textdomains for a plugin.
 * @param  string $slug The given plugin folder/ file slug.
 * @param  bool $extensions For using this loading function for extensions.
 * @param  bool $neutral If a plugin ignores formal/ informal variants, and is "neutral".
 *
 * @return string Function load_textdomain() with given parameters.
 */
function ddw_wcde_load_custom_translations( $textdomains, $slug, $extensions = FALSE, $neutral = FALSE ) {
	
	/** Get locale setting from WordPress */
	$locale = get_locale();

	/** Set initial defaults */
	$variant_slug = '';
	$mofilepath   = '';

	/** Language variant checks - formal/ informal */
	if ( ! $extensions && ! ddw_wcde_woocommerce_is_informal() ) {

		$variant_slug = ( ! $neutral ) ? 'sie-version/' : '';

	} elseif ( ! $extensions && ddw_wcde_woocommerce_is_informal() ) {

		$variant_slug = ( ! $neutral ) ? 'du-version/' : '';

	}  // end if


	/** Making base slug filterable */
	$wcde_main_slug = 'woocommerce-de';
	$wcde_main_slug = apply_filters( 'wcde_filter_main_slug', esc_attr( $wcde_main_slug ) );

	/** WP_LANG_DIR file path to check/ load */
	$wcde_wp_lang_dir_path = trailingslashit( WP_LANG_DIR ) . $wcde_main_slug . '/' . $slug . '/' . $variant_slug . $slug . '-' . $locale . '.mo';

	/** WP_LANG_DIR custom file path to check/ load - especially for backwards compatibility */
	$wcde_wp_lang_dir_custom_path = trailingslashit( WP_LANG_DIR ) . 'woocommerce-de/custom/' . $slug . '-' . $locale . '.mo';

	/** (Site) UPLOAD_DIR file path to check/ load */
	$wcde_upload_dir_path = ddw_wcde_get_site_upload_location( 'path' ) . $wcde_main_slug . '/' . $slug . '/' . $variant_slug . $slug . '-' . $locale . '.mo';

	/** WP_PLUGIN_DIR file path to check/ load --- fallback to our plugin! */
	$wcde_plugindir_slug = apply_filters(
		'wcde_filter_plugindir_slug',
		WCDE_PLUGIN_BASEDIR
	);

	/** Set branch slug part */
	if ( $extensions ) {

		$wc_branch = 'wc-pomo-extensions';

	} else {

		$wc_branch = ( ddw_wcde_woocommerce_current() ) ? 'wc-pomo' : 'wc-pomo-21x';

	}  // end if

	$wcde_plugin_path = trailingslashit( WP_PLUGIN_DIR ) . $wcde_plugindir_slug . trailingslashit( $wc_branch ) . $variant_slug . $slug . '-' . $locale . '.mo';


	/** (1) WP_LANG_DIR branch: */
	if ( is_readable( $wcde_wp_lang_dir_path ) ) {

		$mofilepath = $wcde_wp_lang_dir_path;

	}

		/** (2) WP_LANG_DIR custom branch: */
	elseif ( is_readable( $wcde_wp_lang_dir_custom_path ) ) {
		
		$mofilepath = $wcde_wp_lang_dir_custom_path;

	}

		/** (3) UPLOAD_DIR branch: */
	elseif ( is_readable( $wcde_upload_dir_path ) ) {
		
		$mofilepath = $wcde_upload_dir_path;

	}

		/** (4) Plugin standard branch: */
	elseif ( is_readable( $wcde_plugin_path ) ) {

		$mofilepath = $wcde_plugin_path;

	}  // end if/ elseif language location folders


	/** Prepare for output of translations */
	if ( $mofilepath ) {

		/** Repeat for every given textdomain of our array */
		foreach ( (array) $textdomains as $textdomain ) {

			/** Finally load every textdomain from the given .mo file path */
			load_textdomain( $textdomain, $mofilepath );

		}  // end foreach

	}  // end if

}  // end of function ddw_wcde_load_custom_translations


/**
 * Helper function:
 * Search for a specific translation string and add changed text.
 *    NOTE: Provides fallback to default value if option is empty.
 *          Also works for default installs ('en_US' locale).
 *
 * @since  3.0.19
 *
 * @uses   get_option()
 *
 * @param  string $option_key Option key of our own options array. [Upcoming!]
 * @param  array  $strings Array of original text strings used by WooCommerce.
 * @param  string $default_translation A fallback default translation if the
 *                                     user setting may be empty.
 * @param  string $base_domain String of basis textdomain in which the string
 *                             swap is executed. Fallback is 'woocommerce'.
 *
 * @global $l10n
 *
 * @return string Changed string for display. Merged to global object $l10n/MO.
 *
 * @todo   Mapping $option_key to our options array - we have to wait for switch
 *         of WooCommerce Core to options array saving...
 */
function ddw_wcde_custom_strings_via_l10n_global( $option_key, $strings, $default_translation, $base_domain = '' ) {

	global $l10n;

	/** Get our option [Upcoming!] */
	//$wcde_options = get_option( 'wcde-options' );

	$base_domain = ( empty( $base_domain ) || ! isset( $base_domain ) ) ? 'woocommerce' : esc_attr( $base_domain );

	/** Perform string swap for each string of our array with keys/strings */
	foreach ( (array) $strings as $string ) {

		/** Set label logic */
		$custom_label = $default_translation;

		/** Tweak/add translation/custom label within 'woocommerce' textdomain */
		if ( isset( $l10n[ $base_domain ] )
				&& isset( $l10n[ $base_domain ]->entries[ $string ] )
		) {

			$l10n[ $base_domain ]->entries[ $string ]->translations[0] = $custom_label;

		} else {

			$mo = new MO();

			$mo->add_entry(
				array(
					'singular'     => $string,
					'translations' => array( $custom_label )
				)
			);

			if ( isset( $l10n[ $base_domain ] ) ) {

				$mo->merge_with( $l10n[ $base_domain ] );

			}  // end if
		 
			$l10n[ $base_domain ] = &$mo;

		}  // end if

	}  // end foreach
	
}  // end of function ddw_wcde_custom_strings_via_l10n_global


/**
 * Helper function for checking if we are in "Edit Product" mode.
 *
 * @since  3.1.1
 *
 * @uses   get_post_type()
 *
 * @return bool TRUE if in editing 'product' post type context, otherwise FALSE.
 */
function ddw_wcde_woocommerce_is_editing_product() {

	if ( ! empty( $_GET[ 'post_type' ] ) && 'product' == $_GET[ 'post_type' ] ) {

		return TRUE;

	}  // end if

	if ( ! empty( $_GET[ 'post' ] ) && 'product' == get_post_type( $_GET[ 'post' ] ) ) {

		return TRUE;

	}  // end if

	if ( ! empty( $_REQUEST[ 'post_id' ] ) && 'product' == get_post_type( $_REQUEST[ 'post_id' ] ) ) {

		return TRUE;

	}  // end if

	return FALSE;

}  // end of function ddw_wcde_woocommerce_is_editing_product


add_filter( 'admin_post_thumbnail_html', 'ddw_wcde_tweak_product_image_metabox_content', 99 );
/**
 * Output an additional user advise for the featured/product image on the edit
 *    product screen.
 *
 * @since  3.1.1
 *
 * @uses   get_current_screen()
 *
 * @return string Additional content string for the featured/ product image meta box.
 */
function ddw_wcde_tweak_product_image_metabox_content( $content ) {

	/** Get current sreen ID */
	$screen = get_current_screen();

	/** Only in German-based environment and for 'product' post type */
	if ( wcde_is_german()
		&& ! empty( $screen )
		&& in_array( $screen->post_type, array( 'product' ) )
	) {

		$content .= '<p class="hide-if-no-js description"><small>Großes Hauptproduktbild in der Besucheransicht (Frontend). Produktgaleriebilder werden dagegen zusätzlich und kleiner dargestellt.</small></p>';

	}  // end if

	/** Output our additional content */
	return $content;

}  // end of function ddw_wcde_tweak_product_image_metabox_content