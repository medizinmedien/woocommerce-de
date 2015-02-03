<?php
/**
 * View/ Markup for "Admin Help Tab" area.
 *
 * @package    DDWPinfo Library
 * @subpackage Admin Views
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
 * Help tab start content.
 *
 * @since 1.0.0
 */
function ddwpinfo_help_content_start() {

	/** Begin markup: */
	?>
		<h3>Sprach-Plugins:</h3>

		<ul>
			<li>Herausgeber: David Decker - DECKERWEB.de</li>
			<li>Lizenz: GPL-2.0+</li>
		</ul>

		<h4>Support:</h4>
		<p>
			<strong>Bei kostenlosen Plugins:</strong> Support wird nur als reiner "Produkt-Support" kostenlos angeboten, d.h. liegen konkrete, bestätigte Fehler im Plugin und/ oder den Übersetzungen vor, werden diese korrigiert. Weiterhin bin ich bestrebt das Benutzererlebnis weiter zu verbessern. — Benutzersupport wird nicht angeboten, d.h. bei Problemen mit Ihrer Installation usw. kann ich nicht kostenlos weiterhelfen. Es sei denn, Sie buchen eine reguläre, kostenpflichtige Wartungsdienstleistung zu üblichen Abrechnungskonditionen bei DECKERWEB. 
		</p>
		<p>
			<strong>Bei kostenpflichtigen Premium-Plugins:</strong> Support ist im Kaufpreis mit enthalten. Verwenden Sie bitte die auf der entsprechenden Plugin-Seite bzw. beim Kauf erhaltenen Informationen, wo und wie der Support genau abläuft.
		</p>

	<?php
	/** ^ End markup */

}  // end of function ddwpinfo_help_content_start


/**
 * Helper function for returning the Help Sidebar content.
 *
 * @since  1.0.0
 *
 * @uses   ddwpinfo_plugin_get_data() To display various data of this plugin.
 *
 * @return string HTML content for help sidebar.
 */
function ddwpinfo_help_sidebar_content() {

	$ddwpinfo_help_sidebar_content = '<p><strong>Mehr über den Plugin-Autor</strong></p>' .
			'<p>Vernetzen:<br /><a href="http://twitter.com/deckerweb" target="_blank" title="@ Twitter">Twitter</a> | <a href="http://www.facebook.com/deckerweb.service" target="_blank" title="@ Facebook">Facebook</a> | <a href="http://deckerweb.de/gplus" target="_blank" title="@ Google+">Google+</a> | <a href="http://deckerweb.de/" target="_blank" title="@ deckerweb.de">deckerweb</a></p>' .
			'<p><a href="http://profiles.wordpress.org/daveshine/" target="_blank" title="@ WordPress.org">@ WordPress.org</a></p>';

	return apply_filters( 'ddwpinfo_filter_help_sidebar_content', $ddwpinfo_help_sidebar_content );

}  // end of function ddwpinfo_help_sidebar_content


/**
 * Helper function for returning the Help Sidebar content - extra for plugin setting page.
 *
 * @since  1.0.0
 *
 * @return string Extra HTML content for help sidebar.
 */
function ddwpinfo_help_sidebar_content_extra() {

	$ddwpinfo_help_sidebar_content_extra = '<p><strong>Aktionen</strong></p>' .
		'<p><a class="button button-primary" href="http://deckerweb.de/sprachdateien/spenden/" target="_new"><strong>&rarr; Spenden</strong></a></p>' .
		'<p><a class="button button-secondary" href="http://deckerweb.de/kontakt/" target="_new">&rarr; Support-Kontakt</a></p>';

	return apply_filters( 'ddwpinfo_filter_help_sidebar_content_extra', $ddwpinfo_help_sidebar_content_extra );

}  // end of function ddwpinfo_help_sidebar_content_extra