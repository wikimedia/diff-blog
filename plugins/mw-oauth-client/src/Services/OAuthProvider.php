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

namespace MW\WPOAuth\Services;

use WP_User;
use MW\Lib\MWOAuthProvider;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

use MW\WPOAuth\Helpers;
use MW\WPOAuth\Stores\UserStore;

/**
 * Extension of the base MWOAuthProvider that provides specific functionality
 * unique to this plugin
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     https://opensource.org/licenses/GPL-2.0 GPL2.0
 * @copyright   Wikimedia Foundation
 */
final class OAuthProvider extends MWOAuthProvider {

	/**
	 * Returns a new random string to use as the state parameter in an
	 * authorization flow.
	 *
	 * @param  int $length Length of the random string to be generated.
	 * @return string
	 */
	protected function getRandomState( $length = 32 ) {
		return wp_create_nonce( Helpers::PLUGIN_SLUG . '_oauth_request' );
	}

	/**
	 * Returns true if a valid state key is passed for the current request
	 *
	 * @param string $state
	 * @return bool
	 */
	public function validateState( string $state ): bool {
		return wp_verify_nonce( $state, Helpers::PLUGIN_SLUG . '_oauth_request' );
	}

	/**
	 * Processes a successful resource owner details request and either tries to
	 * locate a matching existing user, or registers a new WP user if one cannot
	 * be found.
	 *
	 * @param  array $response
	 * @param  AccessToken $token
	 * @throws IdentityProviderException
	 * @return WP_User
	 */
	protected function createResourceOwner( array $response, AccessToken $token ) {

		if ( $response['blocked'] ) {
			throw new IdentityProviderException( __( 'This user has been blocked', 'mw-oauth' ), 403, $response );
		}

		if ( empty( $response['email'] ) ) {
			throw new IdentityProviderException( __( 'Please verify your email address in your Wikimedia account and try again.', 'mw-oauth' ), 406, $response );
		}

		/**
		 * Users that have either registered directly through the SSO plugin, or
		 * linked an existing account in the past can be identified by the _mw_username
		 * meta key. These users do not require any further processing
		 */
		$user = UserStore::get_by_mw_username( $response['username'] );
		if ( $user && ! is_wp_error( $user ) ) {
			// Return the identified user after passing through the update filter.
			return $this->updateResourceOwner( $user, $response, $token );
		}

		// Identifying a user by _mw_username either returned no matches or an error.
		// Assume the account doesn't exist and try to register them as a new user instead.
		if ( ! $user || is_wp_error( $user ) ) {
			$user = $this->maybeRegisterUser( $response );
		}

		// All methods of locating a user failed. They either never existed or there was
		// an unknown error while registering them
		if ( ! $user || is_wp_error( $user ) ) {
			throw new IdentityProviderException( __( 'There was an unknown error logging you in.', 'mw-oauth' ), 600, $response );
		}

		return $this->updateResourceOwner( $user, $response, $token );
	}

	/**
	 * Utility function used to update mutable user profile fields for the
	 * supplied user
	 *
	 * @param mixed $response
	 * @param WP_User $user
	 * @return WP_User
	 */
	protected function updateResourceOwner( WP_User $user, array $response, AccessToken $token ): WP_User {

		if ( $response['email'] !== $user->user_email ) {
			$user->user_email = sanitize_text_field( $response['email'] );
			wp_update_user( $user );
		}

		update_user_meta( $user->ID, '_mwoauth_token', (string) $token );

		return $user;
	}

	/**
	 * Tries to locate an existing user based on their username/email and enrolls them
	 * into SSO, otherwise it will register the user and set their SSO profile up.
	 *
	 * @param array $response
	 * @return WP_User?
	 */
	public function maybeRegisterUser( array $response ) {

		$userdata = array(
			'user_login'   => sanitize_text_field( $response['username'] ),
			'user_email'   => sanitize_text_field( $response['email'] ),
			'display_name' => sanitize_text_field( $response['realname'] ),
		);

		$user    = UserStore::get_by_username_and_email( $response['username'], $response['email'] );
		$user_id = $user ? $user->ID : false;

		if ( ! $user_id ) {
			/**
			 * We were not able to find a user with the exact MediaWiki username/email combination
			 *
			 * The next best match will be a user with the same email but no MW username. Email's
			 * are verified by WikiMedia and so if the account has not already been claimed we
			 * can be somewhat certain that the user is the correct owner.
			 */
			$user    = UserStore::get_unclaimed_account_by_email( $response['email'] );
			$user_id = $user ? $user->ID : false;
		}

		if ( ! $user_id ) {
			// We haven't been able to find a user with those exact details so we can
			// go ahead and register them

			/**
			 * @todo: MediaWiki allows multiple users to share the same email as long as the
			 * username is unique. WordPress requires both emails and usernames to be unique.
			 * Consequently, it would be possible at this point for a user to encounter an
			 * a duplicate email error if they are trying to connect a second account with
			 * a unique username but existing email.
			 */
			$userdata['username']  = UserStore::generate_unique_username( $userdata['user_login'] );
			$userdata['role']      = Helpers::option( 'new_user_role', 'subscriber' );
			$userdata['user_pass'] = wp_generate_password( 16 );

			$user_id = wp_insert_user( $userdata );

			update_user_meta( $user_id, '_mwoauth_registered_at', time() );

			if ( ! $user_id || is_wp_error( $user_id ) ) {
				$message = is_wp_error( $user_id ) ? $user_id->get_error_message() : __( 'There was an unknown problem when trying to register your account', 'mw-oauth' );
				throw new IdentityProviderException( $message, 409, $response );
			}
		}

		update_user_meta( $user_id, '_mwoauth_username', (string) $response['username'] );

		return get_user_by( 'ID', $user_id );
	}
}
