<?php
/**
 * GlotPress Format Android XML class
 *
 * @package GlotCore\LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

use GP_Format_Android;

/**
 * Format class used to support Android XML file format.
 */
class Format_Android extends GP_Format_Android {

	/**
	 * Reads a set of original strings from an Android XML file.
	 *
	 * @param string $file_name The name of the uploaded Android XML file.
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
