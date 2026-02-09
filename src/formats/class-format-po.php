<?php
/**
 * GlotPress Format PO / MO classes
 *
 * @package GlotCore/LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

use GP_Format_PO;

/**
 * Format class used to support Portable Object Message Catalog (.po/.pot) file format.
 */
class Format_PO extends GP_Format_PO {

	/**
	 * Reads a set of translations from a PO file.
	 *
	 * @param string     $file_name The name of the uploaded PO file.
	 * @param GP_Project $project   Unused. The project object to read the translations into.
	 *
	 * @return Translations|bool The extracted translations on success, false on failure.
	 */
	public function read_translations_from_file( $file_name, $project = null ) {
		$entries = parent::read_translations_from_file( $file_name, $project );

		return $entries;
	}

	/**
	 * Reads a set of original strings from a PO file.
	 *
	 * @param string $file_name The name of the uploaded PO file.
	 *
	 * @return Translations|bool The extracted originals on success, false on failure.
	 */
	public function read_originals_from_file( $file_name ) {
		$entries = parent::read_originals_from_file( $file_name );

		return $entries;
	}
}

GP::$formats['po'] = new Format_PO();
