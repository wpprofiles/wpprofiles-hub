<?php

/**
 * Generic Utility methods.
 *
 * @package     WPProfiles-Hub
 * @author      Richard Tape, Jeremy Felt
 * @since       0.0.2
 */

namespace WPProfiles\Hub;

class Utils {

	/**
	 * Determine if the passed user (or, if no passed user, the currently logged in user)
	 * is in the profile user role.
	 *
	 * @param mixed $user If null then the currently logged in user. If an int then
	 *              the user with that ID, if a WP_User object, then that user.
	 * @return bool true if the passed|current user is in the profile role, false otherwise.
	 */
	public static function user_is_profile_user( $user = null ) {

		// Sanitize
		if ( is_integer( $user ) ) {
			$user_id = absint( $user );
			$user    = get_user_by( 'id', $user_id );
		}

		if ( null === $user ) {
			$user = wp_get_current_user();
		}

		// By this point we've either massaged the passed $user into a
		// WP_User or we were passed one. If not, bail.
		if ( ! is_a( $user, 'WP_User' ) ) {
			return false;
		}

		if ( ! isset( $user->roles ) || ! is_array( $user->roles ) ) {
			return false;
		}

		/**
		 * This filter is documented in \WPProfiles\Hub\Roles\Profile::__construct()
		 *
		 */
		$role = apply_filters( 'wp_profiles_hub_profile_role_slug', 'profile' );

		// check for profile user role
		if ( ! in_array( $role, $user->roles, true ) ) {
			return false;
		}

		return true;

	}// end user_is_profile_user()

}// end class Utils
