<?php
/**
 * Plugin Name:       GlotCore Limit Import Strings Number
 * Plugin URI:        https://blog.meloniq.net/gp-limit-import-strings-number/
 *
 * Description:       Extends GlotPress by adding functionality to limit the number of strings that can be imported from a file.
 * Tags:              glotpress, limit, import, strings
 *
 * Requires at least: 4.9
 * Requires PHP:      7.4
 * Version:           0.1
 *
 * Author:            MELONIQ.NET
 * Author URI:        https://meloniq.net/
 *
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain:       glotcore-limit-import-strings-number
 *
 * Requires Plugins:  glotpress
 *
 * @package GlotCore\LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

// If this file is accessed directly, then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'GC_LISN_TD', 'glotcore-limit-import-strings-number' );
define( 'GC_LISN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'GC_LISN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * GP Init Setup.
 *
 * @return void
 */
function gp_init() {
	global $glotcore_limitimportstringsnumber;

	require_once __DIR__ . '/src/class-core.php';

	$glotcore_limitimportstringsnumber['core'] = new Core();
}
add_action( 'gp_init', __NAMESPACE__ . '\gp_init' );
