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
 * @license     https://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (or later)
 * @copyright   Wikimedia Foundation
 */

namespace MW\WPOAuth\Stores;

use Exception;
use WP_User_Query;

/**
 * Contains a number of helpful functions used to interact with User records in
 * WordPress.
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 */
class UserStore {
	/**
	 * @param string $username
	 * @param string $email
	 * @return WP_User?
	 */
	public static function get_by_mw_username( string $username, string $email = '' ) {
		$users = get_users(
			array(
				'meta_key'   => '_mwoauth_username',
				'meta_value' => $username,
			)
		);

		return count( $users ) > 0 ? array_shift( $users ) : null;
	}

	/**
	 * @param string $username
	 * @param string $email
	 *
	 * @return WP_User|false
	 */
	public static function get_by_username_and_email( string $username, string $email ) {

		$users_by_email_query = new WP_User_Query(
			array(
				'search'         => $email,
				'search_columns' => array( 'user_email' ),
			)
		);

		$users_by_email = $users_by_email_query->get_results();

		if ( ! $users_by_email || empty( $users_by_email ) ) {
			return false;
		}

		foreach ( $users_by_email as $user ) {
			$mw_username = get_user_meta( $user->ID, '_mwoauth_username', true );
			if ( $user->user_login === $username || $user->user_login === $mw_username ) {
				return $user;
			}
		}

		return false;
	}

	/**
	 * Identifies a user by email that has not been linked to a MW account
	 *
	 * @param string $email
	 * @return array
	 *
	 * @return WP_User|false
	 */
	public static function get_unclaimed_account_by_email( string $email ) {
		$users_by_email_query = new WP_User_Query(
			array(
				'search'         => $email,
				'search_columns' => array( 'user_email' ),
			)
		);

		$users_by_email = $users_by_email_query->get_results();

		foreach ( $users_by_email as $user ) {
			$mw_username = get_user_meta( $user->ID, '_mwoauth_username', true );
			if ( ! $mw_username || empty( $mw_username ) ) {
				return $user;
			}
		}
		return false;
	}

	/**
	 * @param string $username
	 * @param int $index
	 * @param int $limit
	 *
	 * @return string
	 */
	public static function generate_unique_username( string $username, int $index = 0, $limit = 25 ): string {

		$username = sanitize_user( $username );

		if ( ! username_exists( $username ) ) {
			return $username;
		}

		$index++;

		if ( $index > $limit ) {
			throw new Exception( sprintf( 'Maximum number of attempts reached (%d) when generating a unique username', $limit ) );
		}
		$index++;

		$suffixed_username = $username . $index;

		return ! username_exists( $suffixed_username ) ? $suffixed_username : static::generate_unique_username( $username, $index );
	}

	/**
	 * @param int $user_id
	 * @return bool
	 */
	public static function is_sso_user( int $user_id ): bool {
		$token = get_user_meta( $user_id, '_mwoauth_token', true );
		return ! $token || empty( $token );
	}
}
