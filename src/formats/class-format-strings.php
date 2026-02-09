<?php
/**
 * GlotPress Format Mac OSX / iOS Strings Translate class
 *
 * @package GlotCore/LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

use GP_Format_Strings;

/**
 * Format class used to support Mac OS X / iOS Translate strings file format.
 */
class Format_Strings extends GP_Format_Strings {

	/**
	 * Reads a set of original strings from a strings file.
	 *
	 * @param string $file_name The name of the uploaded strings file.
	 *
	 * @return Translations|bool The extracted originals on success, false on failure.
	 */
	public function read_originals_from_file( $file_name ) {
		$entries = parent::read_originals_from_file( $file_name );

		return $entries;
	}
}

GP::$formats['strings'] = new Format_Strings();
