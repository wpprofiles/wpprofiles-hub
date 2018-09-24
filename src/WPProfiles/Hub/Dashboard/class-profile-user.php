<?php

/**
 * Adds the profile user role.
 *
 * @package     WPProfiles-Hub
 * @author      Richard Tape, Jeremy Felt
 * @since       0.0.2
 */

namespace WPProfiles\Hub\Dashboard;

class Profile_User {

	/**
	 * Boot the Profile User role dashboard up!
	 *
	 * @return void
	 */
	public function __construct() {

		$this->register_hooks();

	}//end __construct()

	/**
	 * Register our actions and filters for the profile user role dashboard.
	 *
	 * @return void
	 */
	public function register_hooks() {

		remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

	}// end register_hooks()

}// end class Profile_User
