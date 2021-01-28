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

namespace MW\WPOAuth;

use MW\WPOAuth\Services\OAuthProvider;

/**
 * The main plugin class. Responsible for loading the plugin.
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     https://opensource.org/licenses/GPL-2.0 GPL2.0
 * @copyright   Wikimedia Foundation
 */
class Controller {

	/**
	 * @var OAuthProvider
	 */
	protected $oauth_provider;

	/**
	 * @var bool
	 */
	protected $ready = false;

	/**
	 * Class Constructor
	 */
	public function __construct() {
		$this->services['shortcodes'] = new Shortcodes\Bootstrapper();
		$this->services['user_store'] = new Stores\UserStore();

		$this->boot_oauth_provider();

		new Admin\Controller( $this );
		new Front\Controller( $this );
	}

	/**
	 * @return void
	 */
	public function boot_oauth_provider(): void {

		$key     = Helpers::option( 'key' );
		$secret  = Helpers::option( 'secret' );
		$api_url = Helpers::option( 'wiki_url' );

		if ( empty( $key ) || empty( $secret ) || empty( $api_url ) ) {
			$this->ready = false;
		} else {
			$this->ready                      = true;
			$this->services['oauth_provider'] = new Services\OAuthProvider(
				array(
					'restApiUrl'   => $api_url,
					'redirectUri'  => wp_login_url() . '?action=' . PLUGIN_SLUG . '_callback',
					'clientId'     => Helpers::option( 'key' ),
					'clientSecret' => Helpers::option( 'secret' ),
				)
			);
		}
	}

	/**
	 * @return boolean
	 */
	public function is_ready(): bool {
		return $this->ready;
	}

	/**
	 * Return the OAuthProvider Instance
	 *
	 * @return OAuthProvider
	 */
	public function get_provider(): OAuthProvider {
		return $this->services['oauth_provider'];
	}

	/**
	 * @return void
	 */
	public function enqueue_scripts(): void {
	}
}
