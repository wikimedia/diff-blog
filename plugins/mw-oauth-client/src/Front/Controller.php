<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName
/*
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     https://opensource.org/licenses/GPL-2.0 GPL2.0
 * @copyright   Wikimedia Foundation
 */

namespace MW\WPOAuth\Front;

use MW\WPOAuth\Controller as RootController;

/**
 * Bootstraps the front-facing features of the plguin
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     https://opensource.org/licenses/GPL-2.0 GPL2.0
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

