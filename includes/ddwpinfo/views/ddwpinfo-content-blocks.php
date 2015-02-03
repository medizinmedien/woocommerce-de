<?php
/**
 * View/ Markup for various "Content Blocks" sections.
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
 * Content block for "license & support" info.
 *
 * @since  1.0.0
 *
 * @param  bool $with_translations
 *
 * @return string Echo markup for content block.
 */
function ddwpinfo_content_block_license_support( $with_translations = FALSE ) {

	$support_message = sprintf(
		'Support wird nur als reiner "Produkt-Support" kostenlos angeboten, d.h. liegen konkrete, bestätigte Fehler im Plugin' . '%s' . 'werden diese korrigiert. Weiterhin bin ich bestrebt, das Benutzererlebnis weiter zu verbessern. &mdash; Benutzersupport wird nicht angeboten, d.h. bei Problemen mit Ihrer Installation usw. kann ich nicht kostenlos weiterhelfen. Es sei denn, Sie buchen eine reguläre, kostenpflichtige Wartungsdienstleistung zu üblichen Abrechnungskonditionen bei DECKERWEB.',
		( $with_translations ) ? ' und/ oder den Übersetzungen vor, ' : ' '
	);

	$output = sprintf(
		'<h4 id="lizenz-support">Lizenz &amp; Support</h4>
		<p>Das Plugin ' . '%s' . ' unter 100-prozentiger GPL Lizenz (GPL-2.0+).</p>
		<p>Darüber hinaus wird das Plugin kostenlos angeboten (frei wie in Freibier).</p>
		<p>%s</p>',
		( $with_translations ) ? 'und die beiliegenden Übersetzungen stehen' : 'steht',
		$support_message
	);

	echo $output;

}  // end of function ddwpinfo_content_block_license_support


/**
 * Content block for "donations" info.
 *
 * @since  1.0.0
 *
 * @param  bool $with_translations
 *
 * @return string Echo markup for content block.
 */
function ddwpinfo_content_block_donations( $with_translations = FALSE ) {

	$output = sprintf(
		'<h4 id="spenden">Spenden</h4>
		<p>Über die Spendenbox können Sie direkt die Wartung und Weiterentwicklung des Plugins' . '%s' . ' unterstützen.' . '%s' . '</p><p>Jede finanzielle Unterstützung leistet einen entscheidenden Beitrag! &mdash; Danke für Ihre Unterstützung!</p>',
		( $with_translations ) ? ', sowie natürlich dessen beiliegende Übersetzungen, ' : ' ',
		( $with_translations ) ? ' Beispielsweise ist die Übersetzungspflege sehr zeitaufwändig - Ihre Spende wird mich daher besonders motivieren :).' : ''
	);

	echo $output;

}  // end of function ddwpinfo_content_block_donations


/**
 * Help content block for "Support" info.
 *
 * @since  1.0.0
 *
 * @param  bool $with_translations
 *
 * @return string Echo markup for help content block.
 */
function ddwpinfo_help_block_support( $with_translations = FALSE ) {

	$extra_style = 'style="margin-top: -7px;"';

	$output = sprintf(
		'<h4 id="support">Support:</h4>
		<p ' . $extra_style . '><blockquote>Support wird nur als reiner "Produkt-Support" kostenlos angeboten, d.h. liegen konkrete, bestätigte Fehler im Plugin' . '%s' . ', werden diese korrigiert. Weiterhin bin ich bestrebt das Benutzererlebnis weiter zu verbessern. &mdash; Benutzersupport wird nicht angeboten, d.h. bei Problemen mit Ihrer Installation usw. kann ich nicht kostenlos weiterhelfen. Es sei denn, Sie buchen eine reguläre, kostenpflichtige Wartungsdienstleistung zu üblichen Abrechnungskonditionen bei DECKERWEB.</blockquote></p>',
		( $with_translations ) ? ' und/ oder den Übersetzungen vor' : ''
	);

	echo $output;

}  // end of function ddwpinfo_help_block_support


/**
 * Help content block part for translation values info - for supported plugins.
 *
 * @since  1.0.0
 *
 * @return string Echo markup for help content block.
 */
function ddwpinfo_help_block_values_part() {

	$output = sprintf(
		'<a href="%s" title="Übersetzungsprinzipien von DECKERWEB &hellip;">Übersetzungsprinzipien</a>: konsistent, verständlich, voll geschäftstauglich &rarr; <a href="%s" target="_new" title="Übersetzungsprinzipien von DECKERWEB - ausführliche Informationen &hellip;">ausführliche Informationen zu den Übersetzungsprinzipien</a>',
		esc_url_raw( admin_url( 'index.php?page=deckerweb-translations&tab=values' ) ),
		esc_url( 'http://wpdeutsch.info/prinzipien/' )
	);

	echo $output;

}  // end of function ddwpinfo_help_block_values_part