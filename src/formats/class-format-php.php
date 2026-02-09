<?php
/**
 * GlotPress Format PHP class
 *
 * @package GlotCore/LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

use GP_Format_PHP;

/**
 * Format class used to support PHP file format.
 */
class Format_PHP extends GP_Format_PHP {

	/**
	 * Reads a set of original strings from a PHP file.
	 *
	 * @param string $file_name The name of the uploaded PHP file.
	 *
	 * @return false Always returns false, as this is not currently implemented.
	 */
	public function read_originals_from_file( $file_name ) {
		$entries = parent::read_originals_from_file( $file_name );

		return $entries;
	}

	/**
	 * Reads a set of translations from a PHP file.
	 *
	 * @param string     $file_name The name of the uploaded PHP file.
	 * @param GP_Project $project   Unused. The project object to read the translations into.
	 *
	 * @return false Always returns false, as this is not currently implemented.
	 */
	public function read_translations_from_file( $file_name, $project = null ) {
		$entries = parent::read_translations_from_file( $file_name, $project );

		return $entries;
	}
}

GP::$formats['php'] = new Format_PHP();
