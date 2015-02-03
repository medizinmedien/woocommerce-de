<?php
/**
 * View/ Markup for "Donations Box" area.
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
 * Helper function.
 *
 * @since 1.0.0
 */
function ddwpinfo_donations_box() {

	/** Begin markup: */
	?>

		<div id="box_donations" class="ddwpinfo-box-content">

			<h3>Ihre Spende motiviert mich!</h3>

			<p>
				Jeder Betrag, der als Spende eingeht, hilft, das Angebot guter, konsistenter Übersetzungen für WordPress, Plugins und Themes zu erhalten sowie weiter auszubauen.
			</p>

			<p>
				Jetzt spenden, damit ich <b>bestehende Sprachdateien pflegen und verbessern</b>, sowie <b>neue Übersetzungsprojekte angehen</b> kann:
				<br /><?php ddwpinfo_donations_button(); ?>
			</p>

			<p>
				<a class="button button-primary" href="<?php echo esc_url_raw( admin_url( 'index.php?page=deckerweb-translations&tab=donations' ) ); ?>" title="Weitere Details auf der Spenden-Infoseite&hellip;">Zur Spenden-Seite &rarr;</a>
			</p>

			<p>
				<strong><em>Danke für Ihre Unterstützung!</em></strong>
				<br /><em>~David Decker, Übersetzer</em>
			</p>
			
		</div>

	<?php
	/** ^ End "Donations" box content markup */

}  // end of function ddwpinfo_donations_box