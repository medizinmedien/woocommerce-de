<?php
/**
 * View/ Markup for "Donations" tab section.
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

	<div id="tab_donations" class="ddwpinfo-tab-content">

		<div class="donations-box-before"><?php ddwpinfo_donations_action(); ?></div>

		<h3>Spenden</h3>

		<?php do_action( 'ddwpinfo_after_donations_headline' ); ?>

		<div class="ddwpinfo-alert-box ddwpinfo-alert-green">
			<strong>Sie machen den Unterschied &ndash; mit Ihrer Unterstützung!</strong>
		</div>

		<h4>Warum sollten Sie spenden?</h4>
		<p>
			<strong>Kurz &amp; bündig:</strong> Damit es weiterhin solche Übersetzungen und Sprach-Plugins gibt! :-)
		</p>
		<p>
			Gute, konsistente Übersetzungen brauchen Zeit, viel Zeit sogar. Erst wird die Grundübersetzung angefertigt, danach so gut wie möglich getestet, in der Folgezeit ständig weiter verbessert und gepflegt. Natürlich erfolgen bei Aktualisierungen des Original-Plugins (oder Themes oder WordPress selbst) entsprechende Aktualisierungen meiner Übersetzungen. Dies ist quasi nochmals ein Teil der ursprünglichen Arbeit, d.h. Grundübersetzung, plus Test und Anpassungen. Oftmals haben solche Aktualisierungen von Plugins zwischen 50 und 300 neue Strings. Ein String kann dabei ein einzelnes Wort sein oder auch eine Passage aus mehreren Sätzen. Für so eine Aktualisierung kann man gut und gerne 3-4 Stunden veranschlagen.
		</p>

		<h4>Was geschieht mit den Spenden?</h4>
		<p>
			Alle eingehenden Spenden werden zur Deckung meiner Unkosten verwendet: darunter fällt meine Arbeitszeit fürs Übersetzen, Testen, Anpassen sowie Erstellung und Anpassung von Sprach-Plugins. Außerdem werden damit Serverkosten und Zeit für Anwender-Support abgedeckt.
		</p>

		<h4>Wie funktioniert es?</h4>
		<p>
			Ganz einfach über den "PayPal" Onlinedienst spenden. Ihren Wunschbetrag eingeben und die wenigen weiteren Schritte erledigen.
		</p>

		<div class="ddwpinfo-alert-box ddwpinfo-alert-green">
			<strong>Vielen Dank für Ihre Unterstützung!</strong>
		</div>
		
	</div>

	<div class="donations-box-after"><?php ddwpinfo_donations_action(); ?></div>

<?php
/** ^ End "Donations" tab content markup */