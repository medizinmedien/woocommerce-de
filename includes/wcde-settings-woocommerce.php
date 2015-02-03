<?php
/**
 * Settings within WooCommerce admin settings page.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage WooCommerce Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2014, David Decker - DECKERWEB
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


add_filter( 'woocommerce_settings_tabs_wcdetranslations', 'ddw_wcde_add_translation_settings_content', 20 );
/**
 * Add our settings page content via WooCommerce settings API.
 *
 * @since 3.1.0
 *
 * @uses  woocommerce_admin_fields()
 */
function ddw_wcde_add_translation_settings_content() {

	woocommerce_admin_fields( ddw_wcde_woocommerce_translation_settings() );

}  // end of function ddw_wcde_add_translation_settings_content


add_filter( 'woocommerce_update_options_wcdetranslations', 'ddw_wcde_update_translation_settings_content', 20 );
/**
 * Save & update our options via WooCommerce settings API.
 *
 * @since 3.1.0
 *
 * @uses  woocommerce_update_options()
 */
function ddw_wcde_update_translation_settings_content() {
	
	woocommerce_update_options( ddw_wcde_woocommerce_translation_settings() );

}  // end of function ddw_wcde_update_translation_settings_content


add_filter( 'woocommerce_settings_tabs_array', 'ddw_wcde_add_woocommerce_settings_tab', 25 );
/**
 * Add our own settings tab to WooCommerce settings page.
 *
 * @since  3.1.0
 *
 * @param  string $tabs
 *
 * @return string String of settings tab label.
 */
function ddw_wcde_add_woocommerce_settings_tab( $tabs ) {

	$tabs[ 'wcdetranslations' ] = __( 'German Translations', 'woocommerce-german' );

	return $tabs;

}  // end of function ddw_wcde_add_woocommerce_settings_tab


/**
 * Array of admin setting fields - leveraging the WooCommerce settings API,
 *    using setting field types.
 *
 * @since  3.1.0
 *
 * @return array Array of admin setting fields.
 */
function ddw_wcde_woocommerce_translation_settings() {

	$info_button = sprintf(
		'<a class="button button-secondary" href="%1$s" title="%2$s"><strong>&rarr; %2$s</strong></a>',
		admin_url( 'index.php?page=deckerweb-translations&tab=woocommerce-german' ),
		esc_html__( 'Important Legal Advise', 'woocommerce-german' )
	);

	$donate_button = sprintf(
		'<a class="button button-primary" href="%1$s" target="_new" title="%2$s"><strong>&rarr; %2$s</strong></a>',
		esc_url( 'http://deckerweb.de/sprachdateien/spenden/' ),
		esc_html__( 'Donate NOW!', 'woocommerce-german' )
	);

	$translation_section_desc = sprintf(
		'<div class="alignright alternate" style="margin-left: 40px; padding: 0 15px; width: 30%;">
			<p>%1$s<br />%2$s</p>
			<p>%3$s<br />%4$s</p>
		</div>
		<div>
			<p>%5$s</p><p>%6$s</p>
		</div><div class="clear"></div>',
		__( 'Regarding translations and shop owners:', 'woocommerce-german' ),
		$info_button,
		__( 'Donate for the maintenance of the translations:', 'woocommerce-german' ),
		$donate_button,
		sprintf(
			__( 'Those are the plugin settings for %s.', 'woocommerce-german' ),
			'<em>' . __( 'WooCommerce German (de_DE)', 'woocommerce-german' ) . '</em>'
		),
		__( 'Note: Settings are available after saving and reloading any admin page.', 'woocommerce-german' )
	);

	$wcde_settings_fields = array(

		/** First setting section*/
		array(
			'title' => __( 'German Translation Options', 'woocommerce-german' ),
			'type'  => 'title',
			'desc'  => $translation_section_desc,
			'id'    => 'wcde_translation_options'
		),
		
		/** Use formal translations? */
		array(
			'title'   => __( 'Use German formal translations?', 'woocommerce-german' ),
			'id'      => 'wcde_german_formal',
			'default' => ( get_option( 'woocommerce_informal_localisation_type' ) ) ? get_option( 'woocommerce_informal_localisation_type' ) : 'yes',
			'type'    => 'radio',
			'options' => array(
				'yes' => __( 'Yes, I want formal language!', 'woocommerce-german' ),
				'no'  => __( 'No, I want informal language', 'woocommerce-german' )
			),
			'desc'    => '<p>' . __( 'Default is: formal language - we also recommend to use this language pack is it fits way better with most shopping situations. Otherwise informal translations will be loaded', 'woocommerce-german' ) . '</p>',
		),

		/** Translation loading location */
		array(
			'title'   => __( 'Translation loading location', 'woocommerce-german' ),
			'desc'    => '<p>' . __( 'Decide where to load the translations: Global, or only on Frontend or only in the Admin Area?', 'woocommerce-german' ) . '</p>',
			'id'      => 'wcde_loading_location',
			'default' => 'global',
			'type'    => 'select',
			'class'   => 'chosen_select',
			'options' => array(
				'global'        => __( 'Both, on Frontend and Admin Area', 'woocommerce-german' ),
				'frontend_only' => __( 'Only on Frontend', 'woocommerce-german' ),
				'admin_only'    => __( 'Only on Admin Area', 'woocommerce-german' )
			)
		),

		/** Also load packaged extensions translations? */
		array(
			'title'    => __( 'Load included extensions\'s translations?', 'woocommerce-german' ),
			'desc'     => __( 'Also load the translation files for the few packaged extension\'s translations?', 'woocommerce-german' ),
			'id'       => 'wcde_load_extensions',
			'type'     => 'checkbox',
			'default'  => 'yes',
			'desc_tip' => sprintf(
				__( 'If you have none of the currently %s in use, please deactivate this checkbox to save (translation) loading performance.', 'woocommerce-german' ),
				'<a href="http://wordpress.org/plugins/woocommerce-de/other_notes/#Unterstützte-Extensions-(Erweiterungen)-/-Supported-Extensions" target="_new">' . __( 'supported extensions', 'woocommerce-german' ) . '</a>'
			),
		),

		/** Load internal string swap function? (global strings) */
		array(
			'title'    => __( 'Load included string swap functions?', 'woocommerce-german' ),
			'desc'     => __( 'Also load the included string swap functions?', 'woocommerce-german' ),
			'id'       => 'wcde_load_string_swaps',
			'type'     => 'checkbox',
			'default'  => 'yes',
			'desc_tip' => __( 'If using WooCommerce as product catalog it\'s recommended to deactivate this checkbox to save (translation) loading performance.', 'woocommerce-german' ),
		),

		/** Load another internal string swap function? (admin strings) */
		array(
			'title'    => __( 'Load included admin string swap functions?', 'woocommerce-german' ),
			'desc'     => __( 'Also load the included string swap functions for the admin?', 'woocommerce-german' ),
			'id'       => 'wcde_load_admin_string_swaps',
			'type'     => 'checkbox',
			'default'  => 'yes',
			'desc_tip' => __( 'If not needed for the admin it\'s recommended to deactivate this checkbox to save (translation) loading performance.', 'woocommerce-german' ),
		),

		/** End of first section */
		array(
			'type' => 'sectionend',
			'id'   => 'wcde_translation_options'
		),

	);  // end of array

	/** Return the setting fields for display & saving */
	return (array) $wcde_settings_fields;

}  // end of function ddw_wcde_woocommerce_translation_settings