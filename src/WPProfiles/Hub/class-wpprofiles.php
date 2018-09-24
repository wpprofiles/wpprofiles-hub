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

		$this->setup_profile_user_dashboard();

	}// end __construct()

	/**
	 * Register our actions and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {

		// Run on plugin activation. Add our roles.
		add_action( 'wp_profiles_hub_activate', array( $this, 'add_roles' ) );

		// Run on plugin deactivation. Cleanup.
		add_action( 'wp_profiles_hub_deactivate', array( $this, 'remove_roles' ) );

		// For profile user role, redirect to user profile on log in
		add_filter( 'login_redirect', array( $this, 'login_redirect__redirect_profile_user_to_profile' ), 20, 3 );

	}// end register_hooks()

	/**
	 * Instantiate our class which handles the setup of the profile user screen (at /wp-admin/profile.php)
	 *
	 * @return void
	 */
	public function setup_profile_user_dashboard() {

		$user_dash = new \WPProfiles\Hub\Dashboard\Profile_User();

	}// end setup_profile_user_dashboard()

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

	/**
	 * When a user with the role of profile signs in, we redirect them to their
	 * user profile screen, rather than their main WP Dashboard.
	 *
	 * @param string $redirect_to URL to redirect to.
	 * @param string $request URL the user is coming from.
	 * @param object $user Logged user's data.
	 * @return string The potentially modified location to redirect to.
	 */
	public function login_redirect__redirect_profile_user_to_profile( $redirect_to, $request, $user ) {

		if ( ! \WPProfiles\Hub\Utils::user_is_profile_user( $user ) ) {
			return $redirect_to;
		}

		return admin_url( 'profile.php' );

	}// end login_redirect__redirect_profile_user_to_profile()

}// end class WPProfiles
