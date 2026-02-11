<?php
/**
 * GlotPress Format PO / MO classes
 *
 * @package GlotCore\LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use GP_Format_MO;

/**
 * Format class used to support Machine Object Message Catalog (.mo) file format.
 */
class Format_MO extends GP_Format_MO {

	/**
	 * Reads a set of translations from a MO file.
	 *
	 * @param string     $file_name The name of the uploaded MO file.
	 * @param GP_Project $project   Unused. The project object to read the translations into.
	 *
	 * @return Translations|bool The extracted translations on success, false on failure.
	 */
	public function read_translations_from_file( $file_name, $project = null ) {
		$entries = parent::read_translations_from_file( $file_name, $project );

		/**
		 * Filter the entries read from the file.
		 *
		 * @param Translations|bool $entries The entries read from the file, or false on failure.
		 * @param GP_Format         $format  The format object used to read the file.
		 * @param string            $file_name The name of the uploaded file.
		 * @param GP_Project|null   $project  The project object to read the translations into, or null if not provided.
		 */
		$entries = apply_filters( 'gp_entries_translations_from_file', $entries, $this, $file_name, $project );

		return $entries;
	}

	/**
	 * Reads a set of original strings from a MO file.
	 *
	 * @param string $file_name The name of the uploaded MO file.
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
