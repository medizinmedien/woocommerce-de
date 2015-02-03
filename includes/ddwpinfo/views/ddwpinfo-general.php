<?php
/**
 * View/ Markup for "General" tab section.
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

	<div id="tab_general" class="ddwpinfo-tab-content">
		
		<div class="donations-box-before"><?php ddwpinfo_donations_box(); ?></div>

		<h3>Grundlagen und Allgemeines</h3>

		<?php do_action( 'ddwpinfo_after_general_headline' ); ?>

		<h4>Das Wichtigste Zuerst:</h4>
		<p>
			<a class="button" href="<?php echo esc_url_raw( admin_url( 'index.php?page=deckerweb-translations&tab=imprint' ) ); ?>" title="Wichtige rechtliche Informationen sowie Haftungsausschluss&hellip;">Rechtliche Informationen und Haftungsausschluss &rarr;</a>
		</p>

		<h4>Derzeit aktive Sprach-Plugins (in dieser Installation):</h4>
		<?php ddwpinfo_detect_active_plugins(); ?>
		<p>
			Bitte klicken Sie einen der Links oben bzw. einen der Tabs auf der linken Seite, um ausführliche Informationen zum jeweils <em>aktiven</em> Sprach-Plugin hier zu erhalten.
		</p>

		<h4>Weitere Sprach-Plugins von DECKERWEB:</h4>
		<?php ddwpinfo_detect_inactive_plugins(); ?>

		<h4>Vielen Dank für das Verwenden meiner Übersetzungen bzw. Sprach-Plugins!</h4>
		<p>
			Danke, dass Sie meine <a href="<?php echo esc_url_raw( admin_url( 'index.php?page=deckerweb-translations&tab=values' ) ); ?>" title="Meine Übersetzungsprinzipien&hellip;">Übersetzungen</a> in Form von Sprachdateien und Sprach-Plugins für WordPress verwenden! Es freut mich sehr, wenn die Früchte meiner langjährigen Arbeit im Praxiseinsatz laufen! :-)
		</p>
		<p>
			Meine Motivation ist inspiriert vom Gedanken hinter quelloffener, freier Software (Open Source): <em>Nehmen und an die weltweite Community zurückgeben. Wissen wird dadurch vermehrt, dass es geteilt wird.</em> &mdash; Übrigens, alle meine Plugins für WordPress und meine Übersetzungen stehen unter der GPL Lizenz.
		</p>

	</div>

	<div class="donations-box-after"><?php ddwpinfo_donations_box(); ?></div>

<?php
/** ^ End "General" tab content markup */