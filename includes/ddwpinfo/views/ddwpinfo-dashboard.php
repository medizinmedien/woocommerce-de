<?php
/**
 * View/ Markup for "Dashboard" area.
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
 * @since 1.0.0
 */
function ddwpinfo_dashboard_info() {

	/** Begin markup: */
	?>

		<h4 class="ddwpinfo-dashboard">Deutsche Übersetzungen &rarr; aktive Sprach-Plugins</h4>
		<div class="ddwpinfo-dashboard">
			<ul class="ddwpinfo-dashboard-listing">
				<?php ddwpinfo_active_plugins_dashboard(); ?>
			</ul>
		</div>

	<?php
	/** ^ End "Dashboard Info" area content markup */

}  // end of function ddwpinfo_dashboard_info