<?php

/**
 * Our main plugin class. Fires everything up. Like a less-jacked Terry Crews.
 *
 * @package     WPProfiles-Hub
 * @author      Richard Tape, Jeremy Felt
 * @since       0.0.2
 */

namespace WPProfiles\Hub;

class WPProfiles {

	/**
	 * Boot up WPProfiles Hub.
	 *
	 * @return void
	 */
	public function __construct() {

		$this->register_hooks();

	}// end __construct()

	/**
	 * Register our actions and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {

		// Run on plugin activation. Add our roles.
		add_action( 'wp_profiles_activate', array( $this, 'add_roles' ) );

		// Run on plugin deactivation. Cleanup.
		add_action( 'wp_profiles_deactivate', array( $this, 'remove_roles' ) );

	}// end register_hooks()

	/**
	 * Add our custom Role(s)
	 *
	 * @return void
	 */
	public function add_roles() {

		$this->add_profile_role();

	}// end add_roles()

	/**
	 * Add the Profile Role which is what the vast majority of users will be.
	 *
	 * @return void
	 */
	public function add_profile_role() {
		$profile_role = new \WPProfiles\Hub\Roles\Profile();
		$profile_role->register();
	}// end add_profile_role()


	/**
	 * Remove our custom roles.
	 *
	 * @return void
	 */
	public function remove_roles() {

		$this->remove_profile_role();

	}// end cleanup()

	/**
	 * Remove our profile role.
	 *
	 * @return void
	 */
	public function remove_profile_role() {
		$profile_role = new \WPProfiles\Hub\Roles\Profile();
		$profile_role->deregister();
	}// end remove_profile_role()

}// end class WPProfiles
