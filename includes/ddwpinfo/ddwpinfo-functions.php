<?php
/**
 * Various helper functions.
 *
 * @package    DDWPinfo Library
 * @subpackage Functions
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2013-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://wpautobahn.com/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.0.0
 */

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Setting up an array of our supported plugins.
 *
 * @since  1.0.0
 *
 * @return array Array of supported plugins with some parameters.
 */
function ddwpinfo_supported_language_plugins() {

	/** Array of supported plugins */
	$plugins_list = array(

		'wp-german-formal' => array(
			'key'   => 'WPGF_PLUGIN_BASEDIR',
			'label' => 'WP Deutsch formelle Anrede (WP German Formal)',
			'short' => 'WP Deutsch formelle Anrede',
			'desc'  => 'WordPress in kompletter deutscher Übersetzung: Sie-Anrede, voll geschäftstauglich, verständlich und konsistent. Für Einzel- und Multisite-Installationen.',
			'aurl'  => admin_url( 'index.php?page=deckerweb-translations&tab=wp-german-formal' ),
			'repo'  => 'https://github.com/deckerweb/wp-german-formal',
			'url'   => 'http://deckerweb.de/sprachdateien/',
			//'slug'  => 'wp-german-formal',
		),

/*
		'wp-german-locale' => array(
			'key'   => 'WPGL_PLUGIN_BASEDIR',
			'label' => 'WP Deutsche Lokale-Einstellung',
			'short' => 'WP Deutsche Lokale',
			'desc'  => 'WordPress eine deutsche Spracheinstellung mitgeben; "WPLANG" auf "de_DE" setzen.',
			'aurl'  => admin_url( 'index.php?page=deckerweb-translations&tab=wp-german-locale' ),
			'repo'  => 'https://github.com/decekrweb/wp-german-locale',
			'url'   => 'http://deckerweb.de/sprachdateien/',
			//'slug'  => 'wp-german-locale',
		),
*/

/*
		'load-custom-translations' => array(
			'key'   => 'LCTRL_PLUGIN_BASEDIR',
			'label' => 'Eigene, benutzerdefinierte Übersetzungen laden lassen',
			'short' => 'Eigene Übersetzungen laden',
			'desc'  => 'Lassen Sie benutzerdefinierte Übersetzungen für spezifische WordPress Plugins laden. Diese Sprachdateien werden dann nicht von automatischen Aktualisierungen bzw. "Language Packs" überschrieben, sondern nur von Ihnen kontrolliert!',
			'aurl'  => admin_url( 'index.php?page=deckerweb-translations&tab=load-custom-translations' ),
			'repo'  => 'http://wordpress.org/plugins/load-custom-translations/',
			'url'   => 'http://wordpress.org/plugins/load-custom-translations/',
			'slug'  => 'load-custom-translations',
		),
*/

		'woocommerce-de'   => array(
			'key'   => 'WCDE_PLUGIN_BASEDIR',
			'label' => 'WooCommerce Deutsch &ndash; WooCommerce German (de_DE)',
			'short' => 'WooCommerce Deutsch',
			'desc'  => 'Das WooCommerce Shop-Plugin für WordPress endlich komplett in vernünftigem Deutsch. Sie- und Du-Anrede wählbar. Das beliebte Sprach-Plugin hat sich zum "Klassiker" entwickelt.',
			'aurl'  => admin_url( 'index.php?page=deckerweb-translations&tab=woocommerce-german' ),
			'repo'  => 'http://wordpress.org/plugins/woocommerce-de/',
			'url'   => 'http://wordpress.org/plugins/woocommerce-de/',
			'slug'  => 'woocommerce-de',
		),

		'jetpack-de'       => array(
			'key'   => 'JPDE_PLUGIN_BASEDIR',
			'label' => 'Jetpack Deutsch &ndash; Jetpack German (de_DE)',
			'short' => 'Jetpack Deutsch',
			'desc'  => 'Die Jetpack Plugin-Suite für WordPress endlich komplett in vernünftigem Deutsch, Slang-befreit! Sie- und Du-Anrede wählbar. Das beliebte Sprach-Plugin hat sich zum "Klassiker" entwickelt.',
			'aurl'  => admin_url( 'index.php?page=deckerweb-translations&tab=jetpack-german' ),
			'repo'  => 'http://wordpress.org/plugins/jetpack-de/',
			'url'   => 'http://wordpress.org/plugins/jetpack-de/',
			'slug'  => 'jetpack-de',
		),

		'jigoshop-de'      => array(
			'key'   => 'JSDE_PLUGIN_BASEDIR',
			'label' => 'Jigoshop Deutsch &ndash; Jigoshop German (de_DE)',
			'short' => 'Jigoshop Deutsch',
			'desc'  => 'Das Jigoshop Shop-Plugin für WordPress endlich komplett in vernünftigem Deutsch. Sie- und Du-Anrede wählbar.',
			'aurl'  => admin_url( 'index.php?page=deckerweb-translations&tab=jigoshop-german' ),
			'repo'  => 'http://wordpress.org/plugins/jigoshop-de/',
			'url'   => 'http://wordpress.org/plugins/jigoshop-de/',
			'slug'  => 'jigoshop-de',
		),

/*
		'gravity-forms-de' => array(
			'key'   => 'GFDE_PLUGIN_BASEDIR',
			'label' => 'Gravity Forms Deutsch &ndash; Gravity Forms German (de_DE)',
			'short' => 'Gravity Forms Deutsch',
			'desc'  => 'Das beliebteste Premium-Formularplugin für WordPress komplett in vernünftigem, geschäftstauglichem Deutsch. Sie- und Du-Anrede wählbar; komplett mit allen offiziellen Erweiterungen (Add-Ons/ Zusatzmodulen).',
			'aurl'  => admin_url( 'index.php?page=deckerweb-translations&tab=gravity-forms-german' ),
			'repo'  => 'http://wpautobahn.com/',
			'url'   => 'http://deckerweb.de/sprachdateien/',
			//'slug'  => 'gravity-forms-de',
		),
*/

	);  // end of array

	/** Return the array */
	return $plugins_list;

}  // end of function ddwpinfo_supported_language_plugins


/**
 * Helper function for creating easy & simple admin plugin install links.
 *
 * @since  1.0.0
 *
 * @uses   current_user_can()
 * @uses   is_main_site()
 *
 * @param  string $plugin_slug String of WordPress.org plugin slug.
 * @param  string $text String of plugin label text.
 *
 * @return string String of WordPress.org plugin install link within admin.
 */
function ddwpinfo_plugin_install_link( $plugin_slug = '', $text = '' ) {
	
	/** Bail early if not enough capabilities */
	if ( ! current_user_can( 'install_plugins' ) ) {
		
		return;

	}  // end if

	if ( is_main_site() ) {

		$url = network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=' . $plugin_slug . '&TB_iframe=true&width=600&height=550' );

	} else {

		$url = admin_url( 'plugin-install.php?tab=plugin-information&plugin=' . $plugin_slug . '&TB_iframe=true&width=600&height=550' );

	}  // end if

	/** Actual link title */
	$title_text = sprintf( '%s jetzt installieren', $text );

	/** Create output string */
	$output = sprintf(
		'<a class="add-new-h2 thickbox" href="%s" title="%s"><small>installieren</small></a>',
		esc_url( $url ),
		esc_attr( $title_text )
	);

	/** Return output for display */
	return $output;

}  // end of function ddwpinfo_detect_plugin_install


/**
 * Helper function to check for all supported plugins, that are currently
 *    active, and putting out a list of them.
 *
 * @since 1.0.0
 *
 * @uses  ddwpinfo_supported_language_plugins()
 */
function ddwpinfo_detect_active_plugins() {
	
	/** Array of supported plugins */
	$plugins_list = (array) ddwpinfo_supported_language_plugins();

	/** Start display of list */
	echo '<ul class="ddwpinfo-active-plugins">';

	/** List items */
	foreach ( $plugins_list as $plugin => $plugin_id ) {
		
		/** Only for active plugins */
		if ( defined( $plugin_id[ 'key' ] ) ) {

			$output = '<li><a href="' . esc_url_raw( $plugin_id[ 'aurl' ] ) . '" title="' . esc_html__( $plugin_id[ 'label' ] ) . '">' . $plugin_id[ 'label' ] . '</a></li>';

			echo $output;

		}  // end if

	}  // end foreach

	/** End display of list */
	echo '</ul>';

}  // end of function ddwpinfo_detect_active_plugins


/**
 * Helper function to check for all supported plugins, that are currently
 *    inactive, and putting out a list of them.
 *
 * @since 1.0.0
 *
 * @uses  ddwpinfo_supported_language_plugins()
 * @uses  ddwpinfo_plugin_install_link()
 *
 * @todo  Fallback if all available supported plugins are active (though very
 *        unlikely).
 */
function ddwpinfo_detect_inactive_plugins() {

	/** Array of supported plugins */
	$plugins_list = (array) ddwpinfo_supported_language_plugins();

	/** Start display of list */
	echo '<ul class="ddwpinfo-inactive-plugins">';

	/** List items */
	foreach ( $plugins_list as $plugin => $plugin_id ) {

		/** Only for inactive plugins */
		if ( ! defined( $plugin_id[ 'key' ] ) ) {

			if ( isset( $plugin_id[ 'slug' ] ) ) {

				$install_link = ddwpinfo_plugin_install_link( $plugin_id[ 'slug' ], $plugin_id[ 'label' ] );

			} elseif ( isset( $plugin_id[ 'repo' ] ) && current_user_can( 'install_plugins' ) ) {
			
				$install_link = sprintf(
					'<a class="add-new-h2 download" href="%s" target="_new" title="%s herunterladen zum Installieren"><small>herunterladen</small></a>',
					$plugin_id[ 'repo' ],
					$plugin_id[ 'label' ]
				);

			} else {

				$install_link = '';

			}  // end if

			$output = '<li><a href="' . esc_url( $plugin_id[ 'repo' ] ) . '" target="_new" title="' . esc_html__( $plugin_id[ 'label' ] ) . '">' . $plugin_id[ 'label' ] . '</a> ' . $install_link . '<br /><small>' . $plugin_id[ 'desc' ] . '</small></li>';

			echo $output;

		} else {

			$output = FALSE;

		}  // end if

	}  // end foreach

/*
	if ( ! $output ) {

		echo 'Glückwunsch, Sie haben alle verfügbaren Sprach-Plugins bereits im Einsatz! ;-)';

	}  // end if
*/

	/** End display of list */
	echo '</ul>';

}  // end of function ddwpinfo_detect_inactive_plugins


/**
 * Helper function to check for all supported plugins, that are currently
 *    active, and putting out a list of them - for the Dashboard.
 *
 * @since 1.0.0
 *
 * @uses  ddwpinfo_supported_language_plugins()
 */
function ddwpinfo_active_plugins_dashboard() {
	
	/** Array of supported plugins */
	$plugins_list = (array) ddwpinfo_supported_language_plugins();

	/** List items */
	foreach ( $plugins_list as $plugin => $plugin_id ) {
		
		/** Only for active plugins */
		if ( defined( $plugin_id[ 'key' ] ) ) {

			$output = '<li class="ddwpinfo-global-icon"><a href="' . esc_url_raw( $plugin_id[ 'aurl' ] ) . '" title="' . esc_html__( $plugin_id[ 'label' ] ) . '">' . $plugin_id[ 'short' ] . '</a></li>';

			echo $output;

		}  // end if

	}  // end foreach

}  // end of function ddwpinfo_active_plugins_dashboard


add_action( 'admin_bar_menu', 'ddwpinfo_add_toolbar_items', 90 );
/**
 * Add Toolbar items.
 *
 * @since  1.0.0
 *
 * @uses   ddwpinfo_supported_language_plugins()
 *
 * @global mixed $wp_admin_bar
 */
function ddwpinfo_add_toolbar_items() {
	
	/** Get global */
	global $wp_admin_bar;

	/** Only for logged in users with active admin bar, our items are enabled */
	if ( is_user_logged_in()
		&& is_admin_bar_showing()
	) {

		/** Add our Toolbar main item */
		$wp_admin_bar->add_node( array(  
			'parent' => 'wp-logo-default',  
			'id'     => 'ddwpinfo-deckerweb-translations',  
			'title'  => 'Über Deutsche Übersetzungen',	//'Deutsche Übersetzungen Info'
			'href'   => admin_url( 'index.php?page=deckerweb-translations' ),  
			'meta'   => array( 'title' => 'Info zu: Deutsche Übersetzungen von WordPress - Sprach-Plugins von DECKERWEB' )
		) );

		/** Array of supported plugins */
		$plugins_list = (array) ddwpinfo_supported_language_plugins();

		/** List sub items */
		foreach ( $plugins_list as $plugin => $plugin_id ) {
			
			/** Only for active plugins */
			if ( defined( $plugin_id[ 'key' ] ) ) {

				/** Add Toolbar sub item(s) */
				$wp_admin_bar->add_node( array(  
					'parent' => 'ddwpinfo-deckerweb-translations',  
					'id'     => 'ddwpinfo-' . $plugin,  
					'title'  => $plugin_id[ 'short' ],  
					'href'   => $plugin_id[ 'aurl' ],  
					'meta'   => array( 'title' => $plugin_id[ 'label' ] )
				) );

			}  // end if

		}  // end foreach

	}  // end if

}  // end of function ddwpinfo_add_toolbar_items


add_filter( 'admin_footer_text', 'ddwpinfo_add_admin_footer_info' );
/**
 * Add admin footer info - add it to the existing default footer info.
 *
 * @since  1.0.0
 *
 * @return string Enhanced string for admin footer info (left side).
 */
function ddwpinfo_add_admin_footer_info() {

	/** Our additional info string */
	if ( defined( 'WPGF_PLUGIN_BASEDIR' ) ) {

		$ddwpinfo_string = sprintf(
			'<br />&rarr; <a href="%s" title="%s">%s</a>',
			admin_url( 'index.php?page=deckerweb-translations&tab=wp-german-formal' ),
			'Deutsche WordPress Übersetzung via Sprach-Plugin WP Deutsch formelle Anrede von DECKERWEB',
			'Sprach-Plugin WP Deutsch formelle Anrede'
		);

	} else {

		$ddwpinfo_string = sprintf(
			'<br />&rarr; <a href="%s" title="%s">%s</a>',
			admin_url( 'index.php?page=deckerweb-translations' ),
			'Deutsche Übersetzungen via Sprach-Plugin(s) von DECKERWEB aktiv',
			'Informationen zu aktiven Sprach-Plugins'
		);

	}  // end if

	/** Create the output, using the default existing string/ markup */
	$output = sprintf(
		'<span id="footer-thankyou">%s %s</span>',
		__( 'Thank you for creating with <a href="http://wordpress.org/">WordPress</a>.' ),
		$ddwpinfo_string
	);

	/** Return all output for display - filterable */
	return apply_filters( 'ddwpinfo_filter_admin_footer_text', $output );

}  // end of function ddwpinfo_add_admin_footer_info