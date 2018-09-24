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

		/**
		 * Filters the role slug for the Profile User Role.
		 *
		 * @param string the slug to use for the profile user role.
		 * @since 0.0.5
		 */
		$this->role_slug = apply_filters( 'wp_profiles_hub_profile_role_slug', 'profile' );

		/**
		 * Filters the role display name for the Profile User Role.
		 *
		 * @since 0.0.5
		 */
		$this->display_name = apply_filters( 'wp_profiles_hub_profile_role_display_name', __( 'Profile User', 'wpprofiles-hub' ) );

		$capabilities = array(
			'read'                  => true,
			'edit_profile'          => true,
			'edit_profiles'         => true,
			'edit_other_profiles'   => true,
			'publish_profiles'      => true,
			'read_profile'          => true,
			'read_private_profiles' => true,
			'delete_profile'        => true,
		);

		/**
		 * Filters the role capabilities for the Profile User Role.
		 *
		 * @since 0.0.5
		 */
		$this->capabilities = apply_filters( 'wp_profiles_hub_profile_role_capabilities', $capabilities );

	}// end __construct()

}// end class Profile
