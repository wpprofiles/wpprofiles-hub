<?php

/**
 * Adds the profile user role.
 *
 * @package     WPProfiles-Hub
 * @author      Richard Tape, Jeremy Felt
 * @since       0.0.2
 */

namespace WPProfiles\Hub\Roles;

class Profile extends WPProfiles_Role {

	public function __construct() {

		$this->role_slug    = 'profile';
		$this->display_name = 'Profile User';
		$this->capabilities = array(
			'read'                  => true,
			'edit_profile'          => true,
			'edit_profiles'         => true,
			'edit_other_profiles'   => true,
			'publish_profiles'      => true,
			'read_profile'          => true,
			'read_private_profiles' => true,
			'delete_profile'        => true,
		);

	}// end __construct()

}// end class Profile
