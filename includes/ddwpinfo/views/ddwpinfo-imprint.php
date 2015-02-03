<?php
/**
 * View/ Markup for "Imprint" tab section.
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


/** Begin markup: */
?>

	<div id="tab_imprint" class="ddwpinfo-tab-content">

		<h3>Rechtliche Informationen</h3>

		<?php do_action( 'ddwpinfo_after_imprint_headline' ); ?>

		<div class="ddwpinfo-alert-box ddwpinfo-alert-yellow">
			<h3>Benutzer- und Verbraucherhinweis (Disclaimer):</h3>
			<p>
				Entsprechend aktivierte Sprach-Plugins bzw. verwendete Übersetzungen/ Sprachdateien leisten nur die jeweilige Übersetzung, diese haben nichts mit Datenschutz bzw. "Rechtssicherheit" zu tun. Für die Einhaltung geltender Datenschutzvorschriften sind die Anbieter der entsprechenden Software verantwortlich, nicht die Übersetzungen bzw. der Übersetzer. Bitte informieren Sie sich vor Einsatz entsprechender Funktionen bzw. Plugins über die geltenden Datenschutz- und Rechtsbestimmungen in Ihrem Land bzw. der Europäischen Union (EU).
			</p>
		</div>

		<div class="ddwpinfo-alert-box ddwpinfo-alert-red">
			<h3>Haftungsausschluss:</h3>
			<p>
				Durch den Einsatz der aktivierten Sprach-Plugins bzw. einzelner Übersetzungen/ Sprachdateien entstehen KEINE Garantien für eine korrekte Funktionsweise oder etwaige Verpflichtungen durch den Übersetzer! — Alle Angaben ohne Gewähr. Übersetzungsfehler, Änderungen und Irrtümer ausdrücklich vorbehalten. Verwendung der Plugins inkl. Sprachdateien geschieht ausschliesslich auf Ihre eigene Verantwortung!
			</p>
		</div>

		<h4>Weitergehende Rechtsberatung</h4>
		<p>
			Weitergehende Rechtsberatung dürfen nach geltendem deutschen Recht nur Anwälte mit gültiger Anwaltslizenz erteilen. Bitte informieren Sie sich bei den entsprechenden Kanzleien, besonders bei denen, die auf Online-Recht spezialisiert sind. Dies gilt insbesondere für die Sprach-Plugins für Shop-Software wie "WooCommerce" und "Jigoshop", aber auch für "Jetpack", wo es um Datenschutzrechtliche Aspekte (Double Opt-In, Tracking etc.) geht.
		</p>
		<p>
			Einschlägige Blogs und Webseiten für Shopbetreiber usw., die Industrie- und Handelskammern, Verbraucherschutzzentralen sowie Branchenverbände bieten überdies weiteres Informationsmaterial, Erfahrungswerte und persönliche Beratung. Nutzen Sie diese Möglichkeiten!
		</p>

		<h4>Lizenz</h4>
		<p>
			Alle meine Plugins WordPress, inklusive der Sprach-Plugins und deren beiliegender Übersetzungen stehen unter 100-prozentiger GPL-Lizenz, <a href="http://www.opensource.org/licenses/gpl-license.php" target="_new">GPL-2.0+</a>.
		</p>

		<h4>Impressum &ndash; für Sprachdateien/ Übersetzungen, plus Sprach-Plugins</h4>
		<p>
			Herausgeber der Übersetzungen und Sprach-Plugins, über die auf dieser Seite plus Unterseiten informiert wird, ist David Decker von DECKERWEB. Es gilt das Impressum von deckerweb.de, unter: <a href="http://deckerweb.de/impressum/" target="_new" title="Impressum deckerweb.de">http://deckerweb.de/impressum/</a>
		</p>

	</div>

<?php
/** ^ End "Imprint" tab content markup */