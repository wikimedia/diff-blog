<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth;

use MW\WPOAuth\Services\OAuthProvider;

/**
 * The main plugin class. Responsible for loading the plugin.
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
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
