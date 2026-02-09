<?php
/**
 * Core functionality.
 *
 * @package GlotCore\LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

/**
 * Core class.
 */
class Core {

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->register_formats();

		add_filter( 'gp_entries_originals_from_file', array( $this, 'limit_imported_strings_number' ), 10, 3 );
		add_filter( 'gp_entries_translations_from_file', array( $this, 'limit_imported_strings_number' ), 10, 3 );
	}

	/**
	 * Registers the format classes to be used for reading files.
	 *
	 * @return void
	 */
	public function register_formats() {
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-android.php';
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-jed1x.php';
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-json.php';
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-ngx.php';
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-php.php';
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-po.php';
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-mo.php';
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-properties.php';
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-resx.php';
		require_once GC_LISN_PLUGIN_DIR . '/src/formats/class-format-strings.php';
	}

	/**
	 * Modify the entries read from the file to limit the number of imported strings.
	 *
	 * @param Translations|bool $entries The entries read from the file, or false on failure.
	 * @param GP_Format         $format  The format object used to read the file.
	 * @param string            $file_name The name of the uploaded file.
	 *
	 * @return Translations|bool The modified entries on success, false on failure.
	 */
	public function limit_imported_strings_number( $entries, $format, $file_name ) {
		$entries_original = $entries;

		// If the entries are not an array, return them as is (likely false on failure).
		if ( ! is_array( $entries ) ) {
			return $entries;
		}

		$limit = $this->get_import_strings_limit();
		// If the number of entries exceeds the limit, slice the array to keep only the allowed number of entries.
		if ( count( $entries ) > $limit ) {
			$entries = array_slice( $entries, 0, $limit, true );
		}

		/**
		 * Filter the entries after limiting the number of imported strings.
		 * This filter allows further modification of the entries after they have been limited, and provides access to the original entries before limiting.
		 *
		 * @param Translations|bool $entries The modified entries after limiting the number of imported strings.
		 * @param Translations|bool $entries_original The original entries before limiting the number of imported strings.
		 * @param GP_Format         $format  The format object used to read the file.
		 * @param string            $file_name The name of the uploaded file.
		 */
		$entries = apply_filters( 'glotcore_entries_after_limiting', $entries, $entries_original, $format, $file_name );

		return $entries;
	}

	/**
	 * Returns the limit for the number of imported strings.
	 *
	 * @return int The limit for the number of imported strings.
	 */
	public function get_import_strings_limit() {
		// Default limit for the number of imported strings.
		$default_limit = 1000;
		$limit         = $default_limit;

		if ( defined( 'GLOTCORE_IMPORT_STRINGS_LIMIT' ) ) {
			$limit = (int) GLOTCORE_IMPORT_STRINGS_LIMIT;
		}

		/**
		 * Filter the limit for the number of imported strings.
		 * This filter allows modification of the limit for the number of imported strings, and provides access to the default limit defined in the code.
		 *
		 * @param int $limit The limit for the number of imported strings, after applying the constant if defined.
		 * @param int $default_limit The default limit for the number of imported strings defined in the code (before applying the constant).
		 */
		$limit = apply_filters( 'glotcore_import_strings_limit', $limit, $default_limit );

		return $limit;
	}
}
