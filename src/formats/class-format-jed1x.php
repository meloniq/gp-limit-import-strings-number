<?php
/**
 * GlotPress Format Jed 1.x class
 *
 * @package GlotCore\LimitImportStringsNumber
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

		/**
		 * Filter the entries read from the file.
		 *
		 * @param Translations|bool $entries The entries read from the file, or false on failure.
		 * @param GP_Format         $format  The format object used to read the file.
		 * @param string            $file_name The name of the uploaded file.
		 */
		$entries = apply_filters( 'gp_entries_originals_from_file', $entries, $this, $file_name );

		return $entries;
	}
}
