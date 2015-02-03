<?php
/**
 * Helper functions for the admin - plugin links.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.0.0
 */

/**
 * Exit if accessed directly
 *
 * @since 3.0.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Setting internal plugin helper values.
 *
 * @since 3.1.0
 *
 * @uses  wcde_is_german()
 */
function ddw_wcde_info_values() {

	$wcde_info = array(

		'url_translate'     => 'http://translate.wpautobahn.com/projects/wordpress-plugins-deckerweb/woocommerce-de',
		'url_wporg_faq'     => 'http://wordpress.org/plugins/woocommerce-de/faq/',
		'url_wporg_forum'   => 'http://wordpress.org/support/plugin/woocommerce-de',
		'url_wporg_profile' => 'http://profiles.wordpress.org/daveshine/',
		'url_snippets'      => 'https://gist.github.com/deckerweb/5098515',
		'license'           => 'GPL-2.0+',
		'url_license'       => 'http://www.opensource.org/licenses/gpl-license.php',
		'first_release'     => absint( '2012' ),
		'url_donate'        => wcde_is_german() ? 'http://deckerweb.de/sprachdateien/spenden/' : 'http://genesisthemes.de/en/donate/',
		'url_plugin'        => wcde_is_german() ? 'http://genesisthemes.de/plugins/woocommerce-de/' : 'http://genesisthemes.de/en/wp-plugins/woocommerce-de/'

	);  // end of array

	return $wcde_info;

}  // end of function ddw_wcde_info_values


/**
 * Returns admin URL for WooCommerce settings,
 *    depending on WooCommerce branch (2.1.0+ or 2.0.x).
 *
 * @since  3.1.0
 *
 * @uses   ddw_wcde_woocommerce_current()
 *
 * @return string String of admin URL.
 */
function ddw_wcde_woocommerce_settings_link() {

	return ddw_wcde_woocommerce_current() ? 'admin.php?page=wc-settings' : 'admin.php?page=woocommerce_settings';

}  // end of function ddw_wcde_woocommerce_settings_link


/**
 * Add "Settings" link to plugin page
 *
 * @since  2.0.0
 *
 * @param  string $wcde_links HTML link strings/ admin URLs.
 *
 * @return strings Admin settings pages link.
 */
function ddw_wcde_settings_page_link( $wcde_links ) {

	/** WooCommerce Admin link */
	$wcde_settings_link = sprintf(
		'<a href="%1$s" title="%2$s">%3$s</a> | <a href="%4$s" title="%5$s">%6$s</a>',
		admin_url( ddw_wcde_woocommerce_settings_link() . '&tab=wcdetranslations' ),
		sprintf(
			esc_html__( 'Go to the %s settings page', 'woocommerce-german' ),
			__( 'WooCommerce German (de_DE)', 'woocommerce-german' )
		),
		esc_attr__( 'Translation Settings', 'woocommerce-german' ),
		admin_url( 'index.php?page=deckerweb-translations&tab=woocommerce-german' ),
		'Übersetzungs-Hinweise &hellip;',
		'Hinweise'
	);

	/** Set the order of the links */
	array_unshift( $wcde_links, $wcde_settings_link );

	/** Display plugin settings links */
	return apply_filters( 'wcde_filter_settings_page_link', $wcde_links );

}  // end of function ddw_wcde_settings_page_link


add_filter( 'plugin_row_meta', 'ddw_wcde_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since  1.0.0
 *
 * @uses   ddw_wcde_info_values()
 *
 * @param  string $wcde_links HTML link strings/ URLs.
 * @param  string $wcde_file Plugin file path.
 *
 * @return strings Plugin links.
 */
function ddw_wcde_plugin_links( $wcde_links, $wcde_file ) {

	/** Capability check */
	if ( ! current_user_can( 'install_plugins' ) ) {

		return $wcde_links;

	}  // end if cap check

	/** List additional links only for this plugin */
	if ( $wcde_file == WCDE_PLUGIN_BASEDIR . 'woocommerce-de.php' ) {

		$wcde_info = (array) ddw_wcde_info_values();

		$wcde_links[] = '<a href="' . esc_url( $wcde_info[ 'url_wporg_faq' ] ) . '" target="_new" title="' . __( 'FAQ', 'woocommerce-german' ) . '">' . __( 'FAQ', 'woocommerce-german' ) . '</a>';

		$wcde_links[] = '<a href="' . esc_url( $wcde_info[ 'url_wporg_forum' ] ) . '" target="_new" title="' . __( 'Support', 'woocommerce-german' ) . '">' . __( 'Support', 'woocommerce-german' ) . '</a>';

		$wcde_links[] = '<a href="' . esc_url( $wcde_info[ 'url_snippets' ] ) . '" target="_new" title="' . __( 'Code Snippets for Customization', 'woocommerce-german' ) . '">' . __( 'Code Snippets', 'woocommerce-german' ) . '</a>';

		$wcde_links[] = '<a href="' . esc_url( $wcde_info[ 'url_translate' ] ) . '" target="_new" title="' . __( 'Translations', 'woocommerce-german' ) . '">' . __( 'Translations', 'woocommerce-german' ) . '</a>';

		$wcde_links[] = '<a class="button button-secondary" href="' . esc_url( $wcde_info[ 'url_donate' ] ) . '" target="_new" title="' . _x( 'Donate for Translations', 'Translators: for title attribute', 'woocommerce-german' ) . '"><strong>&rarr; ' . __( 'Donate for Translations', 'woocommerce-german' ) . '</strong></a>';

	}  // end if plugin check

	/** Output the links */
	return apply_filters( 'wcde_filter_plugin_links', $wcde_links );

}  // end of function ddw_wcde_plugin_links


/**
 * Get all WooCommerce screen IDs for its admin pages.
 * NOTE: Based on WooCommerce 2.1.0+ function, but with backwards compat!
 *
 * @since  3.1.0
 *
 * @uses   ddw_wcde_woocommerce_current()
 *
 * @return array Array of IDs of various WooCommerce admin pages.
 */
function ddw_wcde_get_woocommerce_screen_ids() {

	$wc_screen_id = 'woocommerce';	//strtolower( __( 'WooCommerce', 'woocommerce' ) );

	$wc_branch    = ddw_wcde_woocommerce_current() ? 'wc-' : 'woocommerce_';

	return apply_filters( 'wcde_filter_woocommerce_screen_ids', array(
		'toplevel_page_' . $wc_screen_id,
		$wc_screen_id . '_page_' . $wc_branch . 'reports',
		$wc_screen_id . '_page_' . $wc_branch . 'settings',
		$wc_screen_id . '_page_' . $wc_branch . 'status',
		$wc_screen_id . '_page_wc-addons',
		'dashboard_page_wc-about',
		'dashboard_page_wc-credits',
		'dashboard_page_wc-translators',
		'product_page_product_attributes',
		'edit-shop_order',
		'shop_order',
		'edit-product',
		'product',
		'edit-shop_coupon',
		'shop_coupon',
		'edit-product_cat',
		'edit-product_tag',
		'edit-product_shipping_class'
	) );

}  // end of function ddw_wcde_get_woocommerce_screen_ids


add_action( 'current_screen', 'ddw_wcde_woocommerce_help_tab', 45 );
/**
 * Create and display plugin help tab.
 *
 * @since  2.2.0
 *
 * @uses   get_current_screen() To get the ID of current screen.
 * @uses   wc_get_screen_ids() To get all WooCommerce screen IDs.
 * @uses   WP_Screen::add_help_tab() To add help tab module.
 *
 * @global mixed $wcde_woocommerce_screen
 */
function ddw_wcde_woocommerce_help_tab() {

	global $wcde_woocommerce_screen;

	$wcde_woocommerce_screen = get_current_screen();

	/** Display help tabs only for WordPress 3.3 or higher and only on WooCommerce screen IDs */
	if ( ! class_exists( 'WP_Screen' )
		|| ! $wcde_woocommerce_screen
		|| ! in_array( $wcde_woocommerce_screen->id, ddw_wcde_get_woocommerce_screen_ids() )
		|| in_array( $wcde_woocommerce_screen->id, array( 'edit-product', 'edit-shop_coupon' ) )
	) {

		return;

	}  // end if

	/** Add the help tab */
	$wcde_woocommerce_screen->add_help_tab( array(
		'id'       => 'wcde-woocommerce-help',
		'title'    => __( 'WooCommerce German (de_DE)', 'woocommerce-german' ),
		'callback' => apply_filters( 'wcde_filter_help_tab_content', 'ddw_wcde_woocommerce_help_content' ),
	) );

	/** Add help sidebar */
	add_action( 'current_screen', 'ddw_wcde_woocommerce_help_sidebar', 51 );

}  // end of function ddw_wcde_woocommerce_help_tab


/**
 * Add help sidebar.
 *
 * @since 3.1.0
 *
 * @uses  WP_Screen::set_help_sidebar() To add help sidebar module
 * @uses  ddw_wcde_plugin_help_sidebar_content() To get content of help sidebar.
 * @uses  ddw_wcde_help_sidebar_content_extra() To get extra content of help sidebar.
 *
 * @global mixed $GLOBALS[ 'wcde_woocommerce_screen' ]
 */
function ddw_wcde_woocommerce_help_sidebar() {

	$GLOBALS[ 'wcde_woocommerce_screen' ]->set_help_sidebar(
		ddw_wcde_help_sidebar_content_extra() .
		ddw_wcde_plugin_help_sidebar_content()
	);

}  // end of function ddw_wcde_woocommerce_help_sidebar


add_action( 'load-dashboard_page_deckerweb-translations', 'ddw_wcde_ddwpinfo_help_tab', 15 );
/**
 * Load our help tab/ content also on the DDWPinfo Library page.
 *
 * @since  3.1.0
 *
 * @uses   WP_Screen::add_help_tab() To add help tab module.
 *
 * @global mixed $GLOBALS[ 'wcde_woocommerce_screen' ]
 */
function ddw_wcde_ddwpinfo_help_tab() {

	/** Add the help tab */
	$GLOBALS[ 'wcde_woocommerce_screen' ]->add_help_tab( array(
		'id'       => 'wcde-ddwpinfo-help',
		'title'    => __( 'WooCommerce German (de_DE)', 'woocommerce-german' ),
		'callback' => apply_filters( 'wcde_filter_help_tab_content', 'ddw_wcde_woocommerce_help_content' ),
	) );

}  // end of function ddw_wcde_ddwpinfo_help_tab


/**
 * Create and display plugin help tab content.
 *
 * @since  2.2.0
 *
 * @uses   ddw_wcde_plugin_get_data()
 * @uses   wcde_is_german() To detect German-based environment.
 * @uses   ddw_wcde_plugin_help_content_footer()
 */
function ddw_wcde_woocommerce_help_content() {

	echo '<h3>' . __( 'Plugin', 'woocommerce-german' ) . ': ' . __( 'WooCommerce German (de_DE)', 'woocommerce-german' ) . ' <small>v' . esc_attr( ddw_wcde_plugin_get_data( 'Version' ) ) . '</small></h3>';

	/** Display the various content blocks */
	ddw_wcde_help_content_legal_info();
	ddw_wcde_help_content_custom_info();
	ddw_wcde_help_content_themes_info();
	ddw_wcde_help_content_rec_plugins();
	ddw_wcde_help_content_footer();

}  // end of function ddw_wcde_woocommerce_help_tab


/**
 * Help content: Legal advise.
 *
 * @since 3.1.0
 *
 * @uses  ddw_wcde_info_values()
 * @uses  wcde_is_german()
 */
function ddw_wcde_help_content_legal_info() {

	/** Bail early, if no German-based environment */
	if ( ! wcde_is_german() ) {

		return;

	}  // end if

	$wcde_info = (array) ddw_wcde_info_values();

	$class_alternate = 'class="alternate"';

	$wcde_legal_style = 'style="color: #cc0000;"';

	/** 1) FAQ/Legal info for German users */
	$legal_info_one   = '<span ' . $wcde_legal_style . '">Durch den Einsatz dieses Plugins und der damit angebotenen Sprachdateien entstehen KEINE Garantien für eine korrekte Funktionsweise oder etwaige Verpflichtungen durch den Übersetzer bzw. Plugin-Anbieter! — Alle Angaben ohne Gewähr. Änderungen und Irrtümer ausdrücklich vorbehalten. Verwendung des Plugins inkl. Sprachdateien geschieht ausschliesslich auf eigene Verantwortung!</span>';

	$legal_info_two   = 'Dieses Plugin ist ein reines Sprach-/ Übersetzungs-Plugin, es hat nichts mit "Rechtssicherheit" zu tun. Für alle rechtlichen Fragen ist der Shop-Betreiber zuständig, nicht die "Sprachdatei"!</span>';

	$legal_info_three = 'Eine RechtsBERATUNG zu diesem Themenkomplex kann NUR durch einen ANWALT erfolgen (am besten auf Online-Recht spezilisierte Anwälte!). Bitte auch Infos in den einschlägigen Blogs für Shopbetreiber, der (Fach-) Presse sowie von den Industrie- und Handelskammern beachten. -- Ich als Übersetzer und Plugin-Entwickler kann via Sprachdatei KEINE "Rechtssicherheit" garantieren, dies können nur Shop-Betreiber selbst, mit anwaltlicher Unterstützung!';

	$legal_info_four  = 'JA, die sogenannte "Button-Lösung" wird seit Version 2.1.0 dieses Plugins und Sprachdatei-Version 1.5.5 (aka WooCommerce 1.5.5+) unterstützt. &mdash; Weitere Informationen bei den <a href="' . esc_url( $wcde_info[ 'url_wporg_faq' ] ) . '" target="_new" title="Häufige Fragen (FAQ)"><em>Häufigen Fragen (FAQ)</em></a>';

	$legal_table_content = sprintf(
		'<tr %3$s>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong ' . $wcde_legal_style . '>Haftungsausschluss</strong>',
		$legal_info_one,
		$class_alternate
	) .

	sprintf(
		'<tr>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong ' . $wcde_legal_style . '>Hinweis 1</strong>',
		$legal_info_two
	) .

	sprintf(
		'<tr %3$s>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong ' . $wcde_legal_style . '>Hinweis 2</strong>',
		$legal_info_three,
		$class_alternate
	) .

	sprintf(
		'<tr>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong ' . $wcde_legal_style . '>Hinweis 3</strong>',
		$legal_info_four
	);

	$legal_table_labels = sprintf(
		'<tr>
		<th scope="col" colspan="2">%1$s</th>
		</tr>',
		'<span class="ddwpinfo-ues-icon ddwpinfo-legal"></span><span class="ddwpinfo-legal">' . __( 'Important Legal Advise', 'woocommerce-german' ) . '</span>'
	);

	echo '<table class="widefat" style="margin: 20px auto;">';

		echo sprintf( '<thead>%1$s</thead><tfoot></tfoot>', $legal_table_labels );

		echo $legal_table_content;

	echo '</table>';

}  // end of function ddw_wcde_help_content_legal_info


/**
 * Help content: Custom strings & translations.
 *
 * @since 3.1.0
 *
 * @uses  wcde_is_german()
 */
function ddw_wcde_help_content_custom_info() {

	/** Bail early, if no German-based environment */
	if ( ! wcde_is_german() ) {

		return;

	}  // end if

	$class_alternate = 'class="alternate"';
	$small_text = 'style="font-size: 0.6rem;"';

	/** 3) Theme specific info */
	$custom_info_one   = sprintf(
		'Zahlreiche Texte sind über sogenannte <em>Filter</em> (Ankerpunkte für Modifizierungen) und <em>Hooks</em> (Einhängepunkte für eigenen Code) änderbar. Schauen Sie bitte in die offizielle %s oder suchen Sie nach Anleitungen in einschlägigen WooCommerce-Webseiten.',
		'<a href="http://docs.woothemes.com/documentation/plugins/woocommerce/" target="_new">WooCommerce-Dokumentation</a>'
	);

	$custom_info_two   = sprintf(
		'Alternativ ist die Verwendung einer selbstgepflegten Übersetzung über dieses Sprach-Plugin möglich: Die entsprechenden %s-Datei(en) ablegen in besonderen Pfaden (siehe unten) ablegen, wo diese auch sicher vor automatischen Aktualisierungen sind. :) &mdash; Dieser Weg wird prinzipiell nur empfohlen, wenn Sie ab da die weitere Pflege der Übersetzung übernehmen. Will heißen: Das Sprach-Plugin kümmert sich weiterhin ums Laden und Anzeigen Ihrer angepassten Übersetzungen, aber Sie übernehmen die Übersetzungspflege.',
		'<code>*.mo</code>'
	);

	$custom_info_three = 'Nur <em>einen</em> der drei Pfade verwenden - die Abfrage erfolgt in der angegebenen Reihenfolge:<br />' .
		'&middot; <code ' . $small_text . '>/wp-content/languages/woocommerce-de/{dateiname-präfix}/{optional-du-sie-version/}{dateiname-präfix}-de_DE.mo</code>' .
		'<br />&middot; <code ' . $small_text . '>/wp-content/uploads/woocommerce-de/{dateiname-präfix}/{optional-du-sie-version/}{dateiname-präfix}-de_DE.mo</code>' .
		'<br />&middot; bei Multisite: <code ' . $small_text . '>/wp-content/uploads/sites/{site-id}/woocommerce-de/{dateiname-präfix}/{optional-du-sie-version/}{dateiname-präfix}-de_DE.mo</code>';

	$custom_table_content = sprintf(
		'<tr %3$s>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong>Mit WooCommerce-Boardmitteln</strong>',
		$custom_info_one,
		$class_alternate
	) .

	sprintf(
		'<tr>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong>Selbstgepflegte Übersetzungen</strong>',
		$custom_info_two
	) .

	sprintf(
		'<tr %3$s>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong>Alternative Dateipfade</strong>',
		$custom_info_three,
		$class_alternate
	);

	$custom_table_labels = sprintf(
		'<tr>
		<th scope="col" colspan="2">%1$s</th>
		</tr>',
		'<span class="ddwpinfo-ues-icon ddwpinfo-tweak"></span>Textänderungen &amp; eigene Texte verwenden für Passage XYZ ...?'
	);

	echo '<table class="widefat" style="margin: 20px auto;">';

		echo sprintf( '<thead>%1$s</thead><tfoot></tfoot>', $custom_table_labels );

		echo $custom_table_content;

	echo '</table>';

}  // end of function ddw_wcde_help_content_custom_info


/**
 * Help content: Theme specific translation info.
 *
 * @since 3.1.0
 *
 * @uses  wcde_is_german()
 */
function ddw_wcde_help_content_themes_info() {

	/** Bail early, if no German-based environment */
	if ( ! wcde_is_german() ) {

		return;

	}  // end if

	$class_alternate = 'class="alternate"';

	/** 3) Theme specific info */
	$themes_info_one   = 'Zahlreiche Themes bringen für WooCommerce eigene Templates sowie zahlreiche Zusatzfunktionen mit. All diese Sachen haben eigene Texte: diese Textpassagen <strong>müssen im Theme übersetzt werden!</strong>. Solche Zusatztexte sind nicht durch das Sprach-Plugin abgedeckt. Das Sprach-Plugin "WooCommerce Deutsch" lädt <strong>nur</strong> Übersetzungen für das WooCommerce-Basisplugin, plus auf Wunsch einige wenige Erweiterungen (Extensions).';

	$themes_info_two   = sprintf(
		'Bitte fragen Sie zuerst beim Anbieter Ihres Themes nach Übersetzungen (Schon zum Herunterladen? Bereits in Erstellung? Gegen Entgelt machbar?) bzw. Support nach! Wollen Sie selbst übersetzen, empfehlen sich die Werkzeuge %s und/ oder das Plugin %s.',
		'<a href="http://www.poedit.net/" target="_new"><em>Poedit Editor</em></a>',
		'<a href="http://wordpress.org/plugins/codestyling-localization/" target="_new"><em>Codestyling Localization</em></a>'
	);

	$themes_info_three = sprintf(
		'Theme-Unterstützung durch dieses Sprach-Plugin ist nicht vorgesehen oder geplant! Es gitb zu viele verschiedene (Premium-) Themes da draußen! Erstellung von Theme-eigenen Übersetzungen ist auf Wunsch - kostenpflichtig (!) - möglich. Anfragen bitte über %s :)',
		'<a href="http://deckerweb.de/kontakt/" target="_new"><em>deckerweb.de</em></a>'
	);

	$themes_table_content = sprintf(
		'<tr %3$s>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong>Extra Theme-Übersetzungen</strong>',
		$themes_info_one,
		$class_alternate
	) .

	sprintf(
		'<tr>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong>Wie übersetzen?</strong>',
		$themes_info_two
	) .

	sprintf(
		'<tr %3$s>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong>Theme-Support?</strong>',
		$themes_info_three,
		$class_alternate
	);

	$themes_table_labels = sprintf(
		'<tr>
		<th scope="col" colspan="2">%1$s</th>
		</tr>',
		'<span class="ddwpinfo-ues-icon ddwpinfo-themes"></span>Themes und die Shop-Übersetzungen ...!'	//__( 'Themes &amp; Shop Translation Strings', 'woocommerce-german' )
	);

	echo '<table class="widefat" style="margin: 20px auto;">';

		echo sprintf( '<thead>%1$s</thead><tfoot></tfoot>', $themes_table_labels );

		echo $themes_table_content;

	echo '</table>';

}  // end of function ddw_wcde_help_content_themes_info


/**
 * Help content: Recommended plugins.
 *
 * @since 3.1.0
 *
 * @uses  wcde_is_german()
 */
function ddw_wcde_help_content_rec_plugins() {

	/** Bail early if user cannot install plugins */
	if ( ! current_user_can( 'activate_plugins' ) ) {

		return;

	}  // end if

	$class_alternate = 'class="alternate"';

	/** 4) Recommended plugins etc. */
	if ( wcde_is_german() && ! defined( 'WCABA_PLUGIN_BASEDIR' ) ) {

		$rec_plugins_wcaba_info = 'Dieses Plugin fügt der WordPress Wergzeugleiste bzw. Adminbar nützliche Administratorenlinks und Ressourcen für das WooCommerce Shop-Plugin hinzu.';

		$rec_plugins_wcaba = sprintf(
			'<tr>
				<td class="alignright" align="right">%1$s</td>
				<td>%2$s</td>
			</tr>',
			'<a href="http://wordpress.org/plugins/woocommerce-admin-bar-addition/" target="_new" title="WooCommerce Admin Bar Addition"><strong>WooCommerce Admin Bar Addition</strong></a>',
			$rec_plugins_wcaba_info
		);

	} else {

		$rec_plugins_wcaba = '';

	}  // end if

	if ( wcde_is_german() && ! class_exists( 'WooCommerce_Delivery_Notes' ) ) {

		$rec_plugins_wcdn_info = 'Dieses Plugin stellt einfache Rechnungen und Lieferscheine für das WooCommerce Shop Plugin bereit. Es können dabei auch Firmen-/ Shop-Infos ebenso wie persönliche Anmerkungen oder Bedingungen/ Widerrufsbelehrungen zu den Druckseiten hinzugefügt werden.';

		$rec_plugins_wcdn = sprintf(
			'<tr %3$s>
				<td class="alignright" align="right">%1$s</td>
				<td>%2$s</td>
			</tr>',
			'<a href="http://wordpress.org/plugins/woocommerce-delivery-notes/" target="_new" title="WooCommerce Print Invoices & Delivery Notes"><strong>WooCommerce Print Invoices & Delivery Notes</strong></a>',
			$rec_plugins_wcdn_info,
			$class_alternate
		);

	} else {

		$rec_plugins_wcdn = '';

	}  // end if

	$rec_plugins_more = '&raquo; <a href="http://ddwb.me/wccc" target="_new" title="' . __( 'More premium plugins/extensions at CodeCanyon Marketplace', 'woocommerce-german' ) . ' &hellip;">' . __( 'More premium plugins/extensions at CodeCanyon Marketplace', 'woocommerce-german' ) . ' &hellip;</a>' .
	'<br />&raquo; <a href="http://wordpress.org/plugins/search.php?q=woocommerce" target="_new" title="' . __( 'More free plugins/extensions at WordPress.org', 'woocommerce-german' ) . ' &hellip;">' . __( 'More free plugins/extensions at WordPress.org', 'woocommerce-german' ) . ' &hellip;</a>';

	$rec_plugins_table_content = sprintf(
		'<tr %3$s>
			<td class="alignright" align="right">%1$s</td>
			<td>%2$s</td>
		</tr>',
		'<strong>Freie und Premium-Plugins</strong>',
		$rec_plugins_more,
		$class_alternate
	) .

	$rec_plugins_wcaba .

	$rec_plugins_wcdn;

	$rec_plugins_table_labels = sprintf(
		'<tr>
			<th scope="col" colspan="2">%1$s</th>
		</tr>',
		__( 'Other, recommended WooCommerce plugins', 'woocommerce-german' )
	);

	echo '<table class="widefat" style="margin: 20px auto;">';

		echo sprintf( '<thead>%1$s</thead><tfoot></tfoot>', $rec_plugins_table_labels );

		echo $rec_plugins_table_content;

	echo '</table>';

}  // end of function ddw_wcde_help_content_rec_plugins


/**
 * Create and display plugin help tab content for "footer info" part.
 *
 * @since  3.0.1
 *
 * @uses   ddw_wcde_info_values()
 * @uses   ddw_wcde_plugin_get_data()
 *
 * @return string HTML help content footer info.
 */
function ddw_wcde_help_content_footer( $echo = TRUE ) {

	$wcde_info = (array) ddw_wcde_info_values();

	$wcde_legal_style = 'style="color: #cc0000;"';

	/** Set first release year */
	$release_first_year = ( '' != $wcde_info[ 'first_release' ] && date( 'Y' ) != $wcde_info[ 'first_release' ] ) ? $wcde_info[ 'first_release' ] . '&#x02013;' : '';

	$wcde_footer_content = '<p><h4>' . __( 'Important plugin links:', 'woocommerce-german' ) . '</h4>' . 
		'<a class="button" href="' . esc_url( $wcde_info[ 'url_plugin' ] ) . '" target="_new" title="' . __( 'Plugin Website', 'woocommerce-german' ) . '">' . __( 'Plugin Website', 'woocommerce-german' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $wcde_info[ 'url_wporg_faq' ] ) . '" target="_new" title="' . __( 'FAQ', 'woocommerce-german' ) . '">' . __( 'FAQ', 'woocommerce-german' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $wcde_info[ 'url_wporg_forum' ] ) . '" target="_new" title="' . __( 'Support', 'woocommerce-german' ) . '">' . __( 'Support', 'woocommerce-german' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $wcde_info[ 'url_snippets' ] ) . '" target="_new" title="' . __( 'Code Snippets for Customization', 'woocommerce-german' ) . '">' . __( 'Code Snippets', 'woocommerce-german' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $wcde_info[ 'url_translate' ] ) . '" target="_new" title="' . __( 'Translations', 'woocommerce-german' ) . '">' . __( 'Translations', 'woocommerce-german' ) . '</a>' .

		'&nbsp;&nbsp;<a class="button" href="' . esc_url( $wcde_info[ 'url_donate' ] ) . '" target="_new" title="' . __( 'Donate', 'woocommerce-german' ) . '"><strong ' . $wcde_legal_style . '>' . __( 'Donate', 'woocommerce-german' ) . '</strong></a></p>';

	$wcde_footer_content .=	'<p><a href="' . esc_url( $wcde_info[ 'url_license' ] ) . '" target="_new" title="' . esc_attr( $wcde_info[ 'license' ] ). '">' . esc_attr( $wcde_info[ 'license' ] ). '</a> &#x000A9; ' . $release_first_year . date( 'Y' ) . ' <a href="' . esc_url( ddw_wcde_plugin_get_data( 'AuthorURI' ) ) . '" target="_new" title="' . esc_attr__( ddw_wcde_plugin_get_data( 'Author' ) ) . '">' . esc_attr__( ddw_wcde_plugin_get_data( 'Author' ) ) . '</a></p>';

	/** Make filterable */
	$output = apply_filters( 'wcde_filter_help_footer_content', $wcde_footer_content );

	/** Output */
	if ( $echo ) {

		echo $output;

	} else {

		return $output;

	}  // end if

}  // end of function ddw_wcde_help_content_footer


/**
 * Helper function for returning the Help Sidebar content.
 *
 * @since  3.0.0
 *
 * @uses   ddw_wcde_info_values()
 * @uses   ddw_wcde_plugin_get_data()
 *
 * @return string/HTML of help sidebar content.
 */
function ddw_wcde_plugin_help_sidebar_content() {

	$wcde_info = (array) ddw_wcde_info_values();

	$wcde_help_sidebar = '<p><strong>' . sprintf(
		__( 'Plugin author of %s', 'woocommerce-german' ),
		'<em>' . __( 'WooCommerce German (de_DE)', 'woocommerce-german' ) . '</em>'
	) . '</strong></p>' .
			'<p>' . __( 'Social:', 'woocommerce-german' ) . '<br /><a href="http://twitter.com/deckerweb" target="_blank" title="@ Twitter">Twitter</a> | <a href="http://www.facebook.com/deckerweb.service" target="_blank" title="@ Facebook">Facebook</a> | <a href="http://deckerweb.de/gplus" target="_blank" title="@ Google+">Google+</a> | <a href="' . esc_url( ddw_wcde_plugin_get_data( 'AuthorURI' ) ) . '" target="_blank" title="@ deckerweb.de">deckerweb</a></p>' .
			'<p><a href="' . esc_url( $wcde_info[ 'url_wporg_profile' ] ) . '" target="_blank" title="@ WordPress.org">@ WordPress.org</a></p>';

	return apply_filters( 'wcde_filter_help_sidebar_content', $wcde_help_sidebar );

}  // end of function ddw_wcde_plugin_help_sidebar_content


/**
 * Helper function for returning the Help Sidebar content - extra for plugin setting page.
 *
 * @since  3.1.0
 *
 * @uses   ddw_wcde_info_values
 * @uses   ddw_wcde_woocommerce_settings_link()
 *
 * @return string Extra HTML content for help sidebar.
 */
function ddw_wcde_help_sidebar_content_extra() {

//style="margin-top: -5px;"

	$wcde_info = (array) ddw_wcde_info_values();

	$wcde_help_sidebar_content_extra = '<p><strong>' . __( 'Actions', 'woocommerce-german' ) . ':</strong></p>' .

		'<p><a class="button button-secondary" href="' . admin_url( ddw_wcde_woocommerce_settings_link() . '&tab=wcdetranslations' ) . '">' . __( 'Plugin Settings', 'woocommerce-german' ) . '</a></p>' .

		'<p><a class="button button-primary" href="' . esc_url( $wcde_info[ 'url_donate' ] ) . '" target="_new"><strong>&rarr; ' . __( 'Donate', 'woocommerce-german' ) . '</strong></a></p>' .

		'<p><a class="button button-secondary" href="' . esc_url( $wcde_info[ 'url_wporg_forum' ] ) . '" target="_new">&rarr; ' . __( 'Support Forum', 'woocommerce-german' ) . '</a></p><br />';

	return apply_filters( 'wcde_filter_help_sidebar_content_extra', $wcde_help_sidebar_content_extra );

}  // end of function ddw_wcde_help_sidebar_content_extra


add_filter( 'ddwpinfo_filter_tabs_array', 'ddw_wcde_ddwpinfo_tab', 11, 1 );
/**
 * Create new plugin tab for "deckerweb Translations" admin info page.
 *
 * @since  3.1.0
 *
 * @return string Unique tab ID.
 */
function ddw_wcde_ddwpinfo_tab( $tabs ) {

	/** Add new tab */
	$tabs[ 'woocommerce-german' ] = __( 'WooCommerce German (de_DE)', 'woocommerce-german' );

	/** Return tabs (array) */
	return $tabs;

}  // end of function ddw_wcde_ddwpinfo_tab


add_action( 'ddwpinfo_admin_page_tabs_woocommerce-german', 'ddw_wcde_admin_page_tab' );
/**
 * Include tab content markup for this plugin for "deckerweb Translations" admin
 *    info page.
 *
 * @since 3.1.0
 *
 * @uses  Various content block functions of "DDWPinfo Library".
 */
function ddw_wcde_admin_page_tab() {

	/** Begin markup: */
	?>

		<div id="tab_woocommerce-german" class="ddwpinfo-tab-content">

			<div class="donations-box-before"><?php ddwpinfo_donations_box(); ?></div>

			<h3><em>Sprach-Plugin:</em> WooCommerce Deutsch (de_DE)</h3>

			<h4>&rarr; Inhalt</h4>
			<ul class="plugin-content wcde-content">
				<li><a href="#werte">Grundprinzipien</a></li>
				<li><a href="#legaladvise">Wichtige Rechtshinweise</a></li>
				<li><a href="#custom">Textänderungen &amp; eigene Texte verwenden für Passage XYZ ...?</a></li>
				<li><a href="#themes">Themes und die Shop-Übersetzungen ...!</a></li>
				<li><a href="#lizenz-support">Lizenz &amp; Support</a></li>
				<li><a href="#spenden">Spenden</a></li>
			</ul>

			<h4 id="werte">Grundprinzipien</h4>
			<ul class="plugin-values wcde-values">
				<li>Komplette deutsche Übersetzung des WooCommerce Shop-Basisplugins - in formeller SIE-Anrede als auch informeller DU-Anrede!</li>
				<li><?php ddwpinfo_help_block_values_part(); ?></li>
			</ul>
		
			<a name="legaladvise"></a>
			<?php ddw_wcde_help_content_legal_info(); ?>
			<a name="custom"></a>
			<?php ddw_wcde_help_content_custom_info(); ?>
			<a name="themes"></a>
			<?php ddw_wcde_help_content_themes_info(); ?>

			<?php ddwpinfo_content_block_license_support( TRUE ); ?>

			<?php ddwpinfo_content_block_donations( TRUE ); ?>

		</div>

		<div class="donations-box-after"><?php ddwpinfo_donations_box(); ?></div>

	<?php
	/** ^ End tab content markup */

}  // end of function ddw_wcde_admin_page_tab


add_action( 'admin_notices', 'ddw_wcde_plugin_advise_activation' );
/**
 * Show user message once in the admin to point to legal information.
 *
 * @since 3.1.0
 *
 * @uses  get_option()
 * @uses  get_current_screen()
 * @uses  add_option()
 * @uses  ddw_wcde_get_woocommerce_screen_ids()
 * @uses  ddw_wcde_woocommerce_settings_link()
 */
function ddw_wcde_plugin_advise_activation() {

	/** Bail early if message was shown already */
	if ( TRUE === get_option( 'wcde-display-activation-message' ) ) {

		return;

	}  // end if

	/** Get current screen hook */
	$screen = get_current_screen();

	/** If message was not shown yet, just show it: */
	if ( FALSE === get_option( 'wcde-display-activation-message' )
		&& ( 'plugins' === $screen->id || in_array( $screen->id, ddw_wcde_get_woocommerce_screen_ids() ) )
	) {

		/** Add our helper option */
		add_option( 'wcde-display-activation-message', TRUE );

		/** Setup user notice */
		$wcde_notice = '<div class="error"><p>';
			$wcde_notice .= sprintf(
				'<strong>' . __( 'Important legal advise for %1$s plugin', 'woocommerce-german' ) . ':</strong> ' . __( 'Please read the information %2$shere on translations%3$s and %4$shere on settings%3$s!', 'woocommerce-german' ) . ' &mdash;<em>' . __( 'Thank You!', 'woocommerce-german' ) . '</em>',
				'<em>' . __( 'WooCommerce German (de_DE)', 'woocommerce-german' ) . '</em>',
				'<a href="' . admin_url( 'index.php?page=deckerweb-translations&tab=woocommerce-german' ) . '">',
				'</a>',
				'<a href="' . admin_url( ddw_wcde_woocommerce_settings_link() . '&tab=wcdetranslations' ) . '">'
			);
			$wcde_notice .= '<div class="alignright"><small>(' . __( 'This message will only be shown once. Go to any other page/ screen here and it will disappear.', 'woocommerce-german' ) . ')</small></div><div class="clear"></div>';
		$wcde_notice .= '</p></div><!-- /.error -->';

		/** Output the user message */
		echo $wcde_notice;

	}  // end if

}  // end of function ddw_wcde_plugin_advise_activation