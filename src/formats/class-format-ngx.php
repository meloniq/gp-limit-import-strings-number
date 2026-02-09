<?php
/**
 * GlotPress Format NGX Translate class
 *
 * @package GlotCore/LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

use GP_Format_NGX;

/**
 * Format class used to support NGX Translate JSON file format.
 */
class Format_NGX extends GP_Format_NGX {

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

GP::$formats['ngx'] = new Format_NGX();
