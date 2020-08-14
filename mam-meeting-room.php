<?php
/**
 * @package mam-meeting-room
 */
/**
 * Plugin Name: Meeting Room - Moveaheadmedia
 * Plugin URI: https://github.com/AliSal92/mam-meeting-room
 * Description: a Wordpress plugin to add mam meeting room functionalty.
 * Version: 1.0
 * Author: AliSal
 * Author URI: https://github.com/AliSal92

 * Sales Board - Moveaheadmedia is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Sales Board - Moveaheadmedia is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Sales Board - Moveaheadmedia. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * prevent direct access
 */
defined('ABSPATH') or die('</3');

/**
 * Require once the Composer Autoload
 */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The plugin path (eg: use for require templates).
 * Define constants for the plugin
 */
define('MMR_PATH', plugin_dir_path(__FILE__));

/**
 * The plugin url (eg: use for enqueue css/js files).
 * Define constants for the plugin
 */
define('MMR_URL', plugin_dir_url(__FILE__));

/**
 * The base name (eg: use for adding links to the plugin action links).
 * Define constants for the plugin
 */
define('MMR_BASENAME', plugin_basename(__FILE__));


/**
 * The code that runs during plugin activation
 */
function activate_meetingroom_plugin() {
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'activate_meetingroom_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_meetingroom__plugin() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'deactivate_meetingroom__plugin' );

/**
 * Initialize and run all the core classes of the plugin
 */
use Mam\MeetingRoom\InitMeetingRoom;
InitMeetingRoom::registerServices();
