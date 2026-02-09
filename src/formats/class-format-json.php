<?php
/**
 * GlotPress Format JSON class
 *
 * @package GlotCore/LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

use GP_Format_JSON;

/**
 * Format class used to support JSON file format.
 */
class Format_JSON extends GP_Format_JSON {

	/**
	 * Reads a set of original strings from a JSON file.
	 *
	 * @param string $file_name The name of the uploaded JSON file.
	 *
	 * @return Translations|bool The extracted originals on success, false on failure.
	 */
	public function read_originals_from_file( $file_name ) {
		$entries = parent::read_originals_from_file( $file_name );

		return $entries;
	}

	/**
	 * Reads a set of translations from a JSON file.
	 *
	 * @param string     $file_name The name of the uploaded JSON file.
	 * @param GP_Project $project   Unused. The project object to read the translations into.
	 *
	 * @return Translations|bool The extracted translations on success, false on failure.
	 */
	public function read_translations_from_file( $file_name, $project = null ) {
		$entries = parent::read_translations_from_file( $file_name, $project );

		return $entries;
	}
}

GP::$formats['json'] = new Format_JSON();
