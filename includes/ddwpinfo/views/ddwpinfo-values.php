<?php
/**
 * View/ Markup for "Values" tab section.
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

		<h3>Übersetzungsprinzipien &amp; Ziele</h3>

		<?php do_action( 'ddwpinfo_after_values_headline' ); ?>

		<div class="ddwpinfo-alert-box ddwpinfo-alert-green">
			<p>
				<strong>Alles getreu dem Motto:</strong>
			</p>
			<p>
				<em>Keine Scheu, auch vor größeren Änderungen, gegenüber der Ausgangsbasis (Englisches Original oder bestehende andere deutsche Übersetzung), wenn es Konsistenz und Verstehbarkeit erforderlich machen.</em>
			</p>
		</div>
		
		<h4>Schlüssig und konsistent</h4>
		<p>
			Alles soll auf den ersten Blick schlüssig erscheinen. Konsistenz in allen Bereichen: Einheitlichkeit und Wiedererkennbarkeit. Allerdings unter Beachtung des jeweiligen Kontexts und des verfügbaren Platzes. Vereinheitlichung von wiederkehrenden oder ähnlichen Passagen, beispielsweise bei Fehler- oder Statusmeldungen.
		</p>
		
		<h4>Sachgemäß</h4>
		<p>
			So kurz wie möglich und gleichzeitig so verständlich und genau wie möglich. (Der Idealzustand liegt wohl dann irgendwo in der Mitte... :)
		</p>
		<p>
			Verwendung deutscher Begriffe, wo sinnvoll, ansonsten aber auch Fachbegriffe oder selten sogar das englische Originalwort. Wo es die Vertändlichkeit fördert, wurden Klammerzusätze bzw. Erklärungen direkt hinzugefügt, z.B. bei Hilfe-Tabs.
		</p>

		<h4>Geschäftstauglich</h4>
		<p>
			Ziel: Der Sprachstil soll "poliert", unaufdringlich, vornehm zurückhaltend sein. Es muss alles geschäftstauglich sein. Das gilt sowohl für den Adminbereich (Backend) und die Besucheransicht (Frontend) als auch für die optionale Du-Anrede (sofern vorhanden).
		</p>
		
	</div>

<?php
/** ^ End "Values" tab content markup */