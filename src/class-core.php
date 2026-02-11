<?php
/**
 * Core functionality.
 *
 * @package GlotCore\LimitImportStringsNumber
 */

namespace GlotCore\LimitImportStringsNumber;

use GP;

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
		$formats = $this->get_supported_formats();

		// Load the format classes for the supported formats.
		foreach ( $formats as $format_key => $format_class ) {
			$file_path = GC_LISN_PLUGIN_DIR . '/src/formats/class-format-' . $format_key . '.php';
			if ( file_exists( $file_path ) ) {
				require_once $file_path;
			}
		}

		/**
		 * Action triggered after the format classes for the supported formats have been loaded.
		 * This action allows further loading of format classes or modification of the formats array before the format classes are instantiated and registered in GP::$formats.
		 *
		 * @param array $formats An array of format key to format class name mappings for the formats supported by this plugin, after loading the format classes.
		 */
		do_action( 'glotcore_formats_loaded', $formats );

		// Instantiate the format classes and register them in GP::$formats.
		foreach ( $formats as $format_key => $format_class ) {
			if ( class_exists( $format_class ) ) {
				GP::$formats[ $format_key ] = new $format_class();
			}
		}

		/**
		 * Action triggered after the format classes for the supported formats have been instantiated and registered in GP::$formats.
		 * This action allows further modification of the formats registered in GP::$formats after they have been instantiated and registered.
		 *
		 * @param array $formats An array of format key to format class name mappings for the formats supported by this plugin, after instantiating and registering the format classes in GP::$formats.
		 */
		do_action( 'glotcore_formats_registered', $formats );
	}

	/**
	 * Returns an array of format key to format class name mappings for the formats supported by this plugin.
	 *
	 * @return array An array of format key to format class name mappings.
	 */
	public function get_supported_formats() {
		$data = array(
			'android'    => Format_Android::class,
			'jed1x'      => Format_Jed1x::class,
			'json'       => Format_JSON::class,
			'ngx'        => Format_NGX::class,
			'php'        => Format_PHP::class,
			'po'         => Format_PO::class,
			'mo'         => Format_MO::class,
			'properties' => Format_Properties::class,
			'resx'       => Format_ResX::class,
			'strings'    => Format_Strings::class,
		);

		/**
		 * Filter the supported formats for this plugin.
		 *
		 * @param array $data An array of format key to format class name mappings for the formats supported by this plugin.
		 */
		$data = apply_filters( 'glotcore_supported_formats', $data );

		return $data;
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

		// If the entries are not an object, return them as is (likely false on failure).
		if ( ! is_object( $entries ) ) {
			return $entries;
		}

		// If the entries are not an array, return them as is (likely false on failure).
		if ( ! is_array( $entries->entries ) ) {
			return $entries;
		}

		$limit = $this->get_import_strings_limit();
		// If the number of entries exceeds the limit, slice the array to keep only the allowed number of entries.
		if ( count( $entries->entries ) > $limit ) {
			$entries->entries = array_slice( $entries->entries, 0, $limit, true );
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
