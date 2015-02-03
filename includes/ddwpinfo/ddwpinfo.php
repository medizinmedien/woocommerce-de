<?php
/**
 * Main library file.
 * Let load custom translations for WordPress plugins. These won't be overridden
 *    by automatic updates or 'Language Packs', but only controlled by you.
 *
 * @package     DDWPinfo Library
 * @author      David Decker
 * @copyright   Copyright (c) 2013-2014, David Decker - DECKERWEB
 * @license     GPL-2.0+
 * @link        http://deckerweb.de/twitter
 *
 * Copyright (c) 2013-2014 David Decker - DECKERWEB
 *
 *     This file is part of DDWPinfo Library,
 *     a plugin for WordPress.
 *
 *     DDWPinfo Library is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 2 of the License, or (at your option)
 *     any later version.
 *
 *     DDWPinfo Library is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Admin library for info on translations/ language pack plugins of DECKERWEB by
 *    David Decker.
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
 * @version    1.0.2
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
 * Setting constants.
 *
 * @since 1.0.0
 */
/** DDWPINFO lib directory */
define( 'DDWPINFO_LIB_DIR', trailingslashit( dirname( __FILE__ ) ) );

/** Set constant path to the Library URI */
define( 'DDWPINFO_LIB_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );


add_action( 'plugins_loaded', 'ddwpinfo_is_german', 1 );
/**
 * Helper function to determine if in a German locale based environment.
 *
 * @since  1.0.0
 *
 * @uses   get_option()
 * @uses   get_site_option()
 * @uses   get_locale()
 * @uses   ICL_LANGUAGE_CODE Constant of WPML premium plugin, if defined.
 *
 * @return bool If German-based locale, return TRUE, otherwise FALSE.
 */
function ddwpinfo_is_german() {

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
			|| ( defined( 'ICL_LANGUAGE_CODE' ) && ( ICL_LANGUAGE_CODE == 'de' ) )
	) {

		/** Yes, we are in German-based environmet */
		return TRUE;

	} else {

		/** Non-German! */
		return FALSE;

	}  // end if

}  // end of function ddwpinfo_is_german


/**
 * Main class to setup the admin info pages.
 * 
 * @since 1.0.0
 */
class DDWPinfo_Admin_Pages {

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 1.0.0
	 *
	 * @var   object
	 */
	private static $_this;


	/**
	 * Constructor. Hooks all interactions into correct areas to start the class.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		/**
		 * Disallowing a Second Instantiation of our class.
		 *
		 * @link  http://hardcorewp.com/2013/using-singleton-classes-for-wordpress-plugins/
		 *
		 * @since 1.0.0
		 *
		 * @uses  wp_die()
		 */
		if ( isset( self::$_this ) ) {

			$ddwpinfo_notice = sprintf(
				'%s is a singleton class and you cannot create a second instance.',
				get_class( $this )
			);

			wp_die( $ddwpinfo_notice );

		}  // end if

		/** Store the object in a static property */
		self::$_this = $this;

		/** Include our helper functions */
		require_once( DDWPINFO_LIB_DIR . 'ddwpinfo-functions.php' );

		/** Add new submenu of Dashboard admin page */
		add_action( 'admin_menu', array( 'DDWPinfo_Admin_Pages', 'admin_pages' ), 1 );
		add_action( 'network_admin_menu', array( 'DDWPinfo_Admin_Pages', 'admin_pages' ), 1 );

		/** Hook some info into Dashboard widget */
		require_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-dashboard.php' );
		add_action( 'rightnow_end', 'ddwpinfo_dashboard_info' );
		add_action( 'mu_rightnow_end', 'ddwpinfo_dashboard_info' );

		/** Enqueue a few helper styles for Dashboard */
		add_action( 'admin_enqueue_scripts', array( 'DDWPinfo_Admin_Pages', 'dashboard_styles' ) );

	}  // end of method __construct


	/**
	 * Returns the value of "self::$_this".
	 *    This function will be public by default.
	 *    providing read-only access to the single instance used by the plugin's
	 *    class.
	 *
	 * @link   http://hardcorewp.com/2012/enabling-action-and-filter-hook-removal-from-class-based-wordpress-plugins/
	 *
	 * @since  1.0.0
	 *
	 * @return the value of self::$_this.
	 */
	static function this() {

		return $_this;

	}  // end of method this


	/**
	 * Setup the Admin menu in WordPress
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	static function admin_pages() {

		$ddwpinfo_main_page = add_dashboard_page(
			'DECKERWEB Übersetzungen Informationen',
			'Übersetzungen Info',
			'manage_options',
			'deckerweb-translations',
			array( 'DDWPinfo_Admin_Pages', 'setup_default_admin_pages' )
		);

		/** Let helper styles load only on this admin page */
		add_action( 'load-' . $ddwpinfo_main_page, array( 'DDWPinfo_Admin_Pages', 'load_admin_styles' ) );

		/** Setup help tab system */
		add_action( 'load-' . $ddwpinfo_main_page, array( 'DDWPinfo_Admin_Pages', 'admin_help_tab' ), 5 );

		if ( is_admin() ) {

			include_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-admin-help.php' );
			include_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-content-blocks.php' );

		}  // end if

	}  // end method admin_pages


	/**
	 * Helper method for returning string for minifying stylesheets.
	 *
	 * @since  1.0.0
	 *
	 * @return string String for minifying stylesheets.
	 */
	static function script_suffix() {
		
		return ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) || ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ) ? '' : '.min';

	}  // end of method script_suffix


	/**
	 * Helper method for returning string for versioning scripts/ stylesheets.
	 *
	 * @since  1.0.0
	 *
	 * @return string Version string for versioning scripts/ stylesheets.
	 */
	static function script_version() {

		return ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) || ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ) ? time() : filemtime( plugin_dir_path( __FILE__ ) );

	}  // end of method script_version


	/**
	 * Helper method to let load our admin styles only on our own pagehook.
	 *
	 * @since 1.0.0
	 */
	function load_admin_styles() {

		/** Enqueue a few helper styles */
		add_action( 'admin_enqueue_scripts', array( 'DDWPinfo_Admin_Pages', 'admin_styles' ) );

		/** Enqueue core Thickbox script */
		add_action( 'admin_enqueue_scripts', 'add_thickbox' );

	}  // end of method load_admin_styles


	/**
	 * Enqueue our used admin styles.
	 *
	 * @since 1.0.0
	 *
	 * @uses  wp_register_style()
	 * @uses  wp_enqueue_style()
	 */
	function admin_styles() {

		/** First, register our stylesheet */
		wp_register_style(
			'ddwpinfo-admin-styles',
			DDWPINFO_LIB_URI . 'css/ddwpinfo-admin-styles' . self::script_suffix() . '.css',
			array( 'dashicons' ),
			self::script_version(),
			'all'
		);

		/** Second, enqueue our stylesheet */
		wp_enqueue_style( 'ddwpinfo-admin-styles' );

	}  // end of method admin_styles


	/**
	 * Enqueue our used Dashboard styles.
	 *
	 * @since 1.0.0
	 *
	 * @uses  wp_register_style()
	 * @uses  wp_enqueue_style()
	 */
	static function dashboard_styles( $hook ) {

		/** Bail early if not on site/ network Dashboard page */
		if ( 'index.php' != $hook ) {

			return;

		}  // end if

		/** First, register our stylesheet */
		wp_register_style(
			'ddwpinfo-dashboard-styles',
			DDWPINFO_LIB_URI . 'css/ddwpinfo-admin-styles' . self::script_suffix() . '.css',
			array( 'dashicons' ),
			self::script_version(),
			'all'
		);

		/** Second, enqueue our stylesheet */
		wp_enqueue_style( 'ddwpinfo-dashboard-styles' );

	}  // end of method dashboard_styles


	/**
	 * Setup our 2 default admin pages/tabs: "General" and "Imprint".
	 *
	 * Add hooks and filters for plugins to hook in and add their own tabs.
	 *
	 * @since  1.0.0
	 *
	 * @global mixed $ddwpinfo_current_tab
	 */
	function setup_default_admin_pages() {

		global $ddwpinfo_current_tab;

		do_action( 'ddwpinfo_admin_page_start' );

		/** Get current tab */
		$ddwpinfo_current_tab = ( empty( $_GET[ 'tab' ] ) ) ? 'general' : sanitize_text_field( urldecode( $_GET[ 'tab' ] ) );

		/** Begin HTML template markup */
		?>

			<div class="wrap ddwpinfo">
				<h2><?php echo 'DECKERWEB Übersetzungen &ndash; Wichtige Benutzerinformationen'; ?></h2>
				<div class="ddwpinfo-subtitle">Schlüssige, sachgemäßge und geschäftstaugliche Übersetzungen für WordPress</div>
				<div id="ddwpinfo-tab-group" class="ddwpinfo-tab-group vertical-tabs">

					<ul id="ddwpinfo-tabs" class="ddwpinfo-tabs">
						<?php
							$ddwpinfo_tabs = array(
								'general'   => 'Grundlegendes',
								'values'    => 'Übersetzungs&shy;prinzipien',
								'donations' => '<strong>Spenden</strong>',
								'imprint'   => 'Rechtliche Infos'
							);

							/** Allows for hooking in more page tabs */
							$ddwpinfo_tabs = apply_filters( 'ddwpinfo_filter_tabs_array', $ddwpinfo_tabs );

							foreach ( $ddwpinfo_tabs as $tab_id => $tab_label ) {

								echo '<li class="' . $tab_id;

								if ( $ddwpinfo_current_tab == $tab_id ) {

									echo ' active';

								}  // end if

								echo '"><a href="' . admin_url( 'index.php?page=deckerweb-translations&tab=' . $tab_id ) . '" title="' . esc_attr( $tab_label ) . '">' . $tab_label . '</a></li>';

							}  // end foreach

							/** Action Hook after tabs area */
							do_action( 'ddwpinfo_admin_page_tabs' );
						?>
					</ul><!-- end ddwpinfo-tabs .ddwpinfo-tabs //-->

					<div id="ddwpinfo-tab-container" class="ddwpinfo-tab-container">
						<?php
							include_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-donations-button.php' );
							include_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-donations-box.php' );

							switch ( $ddwpinfo_current_tab ) :

								case "general" :
									do_action( 'ddwpinfo_before_general_view' );
									include_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-general.php' );
									do_action( 'ddwpinfo_after_general_view' );
								break;

								case "values" :
									do_action( 'ddwpinfo_before_values_view' );
									include_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-values.php' );
									do_action( 'ddwpinfo_after_values_view' );
								break;

								case "donations" :
									do_action( 'ddwpinfo_before_donations_view' );
									include_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-donations-action.php' );
									include_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-donations.php' );
									do_action( 'ddwpinfo_after_donations_view' );
								break;

								case "imprint" :
									do_action( 'ddwpinfo_before_imprint_view' );
									include_once( DDWPINFO_LIB_DIR . 'views/ddwpinfo-imprint.php' );
									do_action( 'ddwpinfo_after_imprint_view' );
								break;

								default :
									do_action( 'ddwpinfo_admin_page_tabs_' . $ddwpinfo_current_tab );
								break;

							endswitch;
						?>

						<?php do_action( 'ddwpinfo_admin_page_tabs_footer' ); ?>

					</div><!-- end #ddwpinfo-tab-container .ddwpinfo-tab-container //-->

				</div><!-- end #ddwpinfo-tab-group .ddwpinfo-tab-group.vertical-tabs //-->

			</div><!-- end .wrap.ddwpinfo //-->

		<?php
		/** ^ End HTML template markup */

	}  // end of method setup_default_admin_pages


	/**
	 * Set up the Help Tab system.
	 *
	 * @since 1.0.0
	 *
	 * @uses  callback functions located in library file
	 *        'views/ddwpinfo-admin-help.php' with the actual help tab content
	 * @uses  get_current_screen()
	 * @uses  WP_Screen::add_help_tab()
	 * @uses  WP_Screen::set_help_sidebar()
	 * @uses  ddwpinfo_help_sidebar_content()
	 * @uses  ddwpinfo_help_sidebar_content_extra()
	 */
	function admin_help_tab() {

		global $screen;

		/** Get current screen */
		$screen = get_current_screen();

		/** Display help tabs only for WordPress 3.3 or higher */
		if ( ! class_exists( 'WP_Screen' ) || ! $screen ) {

			return;

		}  // end if

		/** Add starting/ general help tab */
		$screen->add_help_tab( array(
			'id'       => 'ddwpinfo-start-help', 
			'title'    => 'DECKERWEB Übersetzungen',
			'callback' => apply_filters( 'ddwpinfo_filter_help_content_start', 'ddwpinfo_help_content_start' ),
		) );

		/** Add help sidebar */
		$screen->set_help_sidebar( ddwpinfo_help_sidebar_content_extra() . ddwpinfo_help_sidebar_content() );

	}  // end of method admin_help_tab

}  // end of main class DDWPinfo_Admin_Pages


add_action( 'plugins_loaded', 'ddwpinfo_admin_init', 15 );
/**
 * @since 1.0.0
 *
 * @uses  ddwpinfo_admin_init() To detect a German locale based environment.
 */
function ddwpinfo_admin_init() {

	/** Bail early if no German-based environment */
	if ( ! ddwpinfo_is_german() ) {

		return;

	}  // end if

	/** Instantiate the main class */
	new DDWPinfo_Admin_Pages();

}  // end of function ddwpinfo_admin_init