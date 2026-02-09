<?php
/**
 * GlotPress Format Jed 1.x class
 *
 * @package GlotCore/LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

use GP_Format_Jed1x;

/**
 * Format class used to support Jed 1.x compatible JSON file format.
 */
class Format_Jed1x extends GP_Format_Jed1x {

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
}

GP::$formats['jed1x'] = new Format_Jed1x();
