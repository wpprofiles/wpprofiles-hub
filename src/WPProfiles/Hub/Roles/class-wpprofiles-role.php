<?php

/**
 * A class which is to be extended when adding new roles.
 *
 * @package     WPProfiles-Hub
 * @author      Richard Tape, Jeremy Felt
 * @since       0.0.2
 */

namespace WPProfiles\Hub\Roles;

class WPProfiles_Role {

	public $role_slug = '';

	public $display_name = '';

	public $capabilities = array();

	/**
	 * Register the role with WordPress. Run initially on plugin activation.
	 *
	 * @return void
	 */
	public function register() {

		add_role( $this->get_role_slug(), $this->get_display_name(), $this->get_capabilities() );

	}// end register()

	/**
	 * Remove our role with WordPress. Run on plugin deactivation.
	 *
	 * @return void
	 */
	public function deregister() {

		remove_role( $this->get_role_slug() );

	}// end deregister()

	/**
	 * Fetch the slug for this role, sanitized.
	 *
	 * @return string the sanitized role slug
	 */
	public function get_role_slug() {

		return sanitize_title_with_dashes( $this->role_slug );

	}// end get_role_slug()


	/**
	 * Fetch this role's display name, sanitized.
	 *
	 * @return string the sanitized display name for this role
	 */
	public function get_display_name() {

		return sanitize_text_field( $this->display_name );

	}// end get_display_name()


	/**
	 * Fetch this role's custom capabilities, if any.
	 *
	 * @return void
	 */
	public function get_capabilities() {

		return $this->capabilities;

	}// end get_capabilities()

}// end class WPProfiles_Role
