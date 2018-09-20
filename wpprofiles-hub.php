<?php
/**
 * WP Profiles Hub
 *
 * @package     WPProfiles-Hub
 * @author      Richard Tape, Jeremy Felt
 * @copyright   2018 WPProfiles
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: WPProfiles Hub
 * Plugin URI:  https://wpprofiles.com/plugins/wpprofiles-hub/
 * Description: The Hub for WP Profiles. Where folks control their profiles.
 * Version:     0.0.4
 * Author:      Richard Tape, Jeremy Felt
 * Author URI:  https://wpprofiles.com/
 * Text Domain: wpprrofiles-hub
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * @Usage $test = new \WPProfiles\Hub\Roles\Profile()
 *        would load the file ./src/WPProfiles/Hub/Roles/class-profile.php
 * @Reference https://tommcfarlin.com/simple-autoloader-for-wordpress/
 */
spl_autoload_register( function( $filename ) {

	// First, separate the components of the incoming file.
	$file_path = explode( '\\', $filename );

	/**
	 * - The first index will always be the namespace since it's part of the plugin.
	 * - All but the last index will be the path to the file.
	 * - The final index will be the filename. If it doesn't begin with 'I' then it's a class.
	 */
	// Get the last index of the array. This is the class we're loading.
	$file_name = '';

	if ( isset( $file_path[ count( $file_path ) - 1 ] ) ) {

		$file_name = strtolower( $file_path[ count( $file_path ) - 1 ] );

		$file_name       = str_ireplace( '_', '-', $file_name );
		$file_name_parts = explode( '-', $file_name );

		// Interface support: handle both Interface_Foo or Foo_Interface.
		$index = array_search( 'interface', $file_name_parts, true );

		if ( false !== $index ) {

			// Remove the 'interface' part.
			unset( $file_name_parts[ $index ] );

			// Rebuild the file name.
			$file_name = implode( '-', $file_name_parts );
			$file_name = "interface-{$file_name}.php";

		} else {
			$file_name = "class-$file_name.php";
		}
	}

	/**
	 * Find the fully qualified path to the class file by iterating through the $file_path array.
	 * The last index is always the file so we append that at the end.
	 */
	$fully_qualified_path = trailingslashit( dirname( __FILE__ ) ) . 'src/';

	$num_file_path = count( $file_path );

	for ( $i = 0; $i < $num_file_path - 1; $i++ ) {
		$fully_qualified_path .= trailingslashit( $file_path[ $i ] );
	}

	$fully_qualified_path .= $file_name;

	// Now include the file.
	if ( stream_resolve_include_path( $fully_qualified_path ) ) {
		include_once $fully_qualified_path;
	}

} );

// Register our activation and deactivation hooks.
register_activation_hook( __FILE__, 'register_activation_hook__wp_profiles_hub_activate' );
register_deactivation_hook( __FILE__, 'register_deactivation_hook__wp_profiles_hub_deactivate' );

/**
 * Register a hook so we can perform actions on plugin activation.
 *
 * @return void
 */
function register_activation_hook__wp_profiles_hub_activate() {

	/**
	 * Activate WP Profiles Hub
	 *
	 * @since 0.0.4
	 */
	do_action( 'wp_profiles_hub_activate' );

}// end register_activation_hook__wp_profiles_hub_activate()

/**
 * Register a hook so we can perform actions on plugin deactivation.
 *
 * @return void
 */
function register_deactivation_hook__wp_profiles_hub_deactivate() {

	/**
	 * Deactivate WP Profiles Hub
	 *
	 * @since 0.0.4
	 */
	do_action( 'wp_profiles_hub_deactivate' );

}// end register_deactivation_hook__wp_profiles_hub_deactivate()

// Boot ourselves up
$wp_profiles = new \WPProfiles\Hub\WPProfiles();
