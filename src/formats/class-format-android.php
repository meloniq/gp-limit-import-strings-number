<?php
/**
 * GlotPress Format Android XML class
 *
 * @package GlotCore/LimitImportStringsNumber
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

		return $entries;
	}
}

GP::$formats['android'] = new Format_Android();
