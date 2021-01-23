<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth\Front;

use MW\WPOAuth\Controller as RootController;

/**
 * Bootstraps the front-facing features of the plguin
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright   Wikimedia Foundation
 */
final class Controller {
	/**
	 * Class Constructor
	 */
	public function __construct( RootController $controller ) {
		new LoginActions();

		add_filter( 'show_password_fields', array( $this, 'prevent_oauth_users_from_changing_password' ), 500, 2 );
	}

	/**
	 * Checks if the current user's account was created by this plugin, and if
	 * so will prevent them from changing their password.
	 *
	 * @param boolean $enable
	 * @param WP_User? $user
	 * @return boolean
	 */
	public function prevent_oauth_users_from_changing_password( $enable, $user ) {
		if ( get_user_meta( $user->ID, '_mwoauth_registerd_at', true ) ) {
			$enable = false;
		}
		return $enable;
	}
}

