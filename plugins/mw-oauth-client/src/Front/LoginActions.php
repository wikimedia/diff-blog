<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth\Front;

use WP_User;
use WP_Error;
use UnexpectedValueException;
use \League\OAuth2\Client\Provider\Exception\IdentityProviderException;

use MW\WPOAuth\Factory;
use MW\WPOAuth\Helpers;

/**
 * Contains all of the logic required to intiate and respond to an
 * OAuth request
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright   Wikimedia Foundation
 */
final class LoginActions {

	/**
	 * @var array
	 */
	protected $error_bag = array();

	/**
	 *
	 */
	public function __construct() {

		add_action( 'login_form', array( $this, 'render_login_button' ) );

		add_filter( 'login_form_' . Helpers::PLUGIN_SLUG, '__return_true' );
		add_action( 'login_form_' . Helpers::PLUGIN_SLUG, array( $this, 'initiate_oauth_request' ) );

		add_filter( 'login_form_' . Helpers::PLUGIN_SLUG . '_callback', '__return_true' );
		add_action( 'login_form_' . Helpers::PLUGIN_SLUG . '_callback', array( $this, 'handle_oauth_response' ) );

		add_filter( 'wp_login_errors', array( $this, 'render_login_errors' ) );

		add_action( 'mw_oauth_login_user', array( static::class, 'login_user' ), 10, 1 );

		add_action( 'login_enqueue_scripts', array( $this, 'login_enqueue_scripts' ), 10 );
	}

	/**
	 * @return void
	 */
	public function login_enqueue_scripts(): void {
		Helpers::enqueue_style( 'mw-oauth-login', 'wp-login.css' );
	}

	/**
	 * Begins the OAuth flow from a custom login_form action
	 *
	 * @return void
	 */
	public function initiate_oauth_request(): void {
		if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], Helpers::PLUGIN_SLUG . '_begin' ) ) {
			wp_die( esc_html__( 'Nonce verification failed' ) );
		}

		Factory::instance()->get_provider()->authorize();
	}

	/**
	 * Handles OAuth server response from custom login_form action
	 *
	 * @return void
	 */
	public function handle_oauth_response(): void {
		$provider = Factory::instance()->get_provider();
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['error'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$error = isset( $_GET['error_description'] ) ? wp_kses( $_GET['error_description'], array( 'strong' ) ) : __( 'An unknown error occured', 'mw-oauth' );

			$this->error_bag['oauth_error'] = $error;
			return;
		}

		// Ensure the state passed in the initial request is valid in an
		// attempt to protect against CSRF attacks
		if ( empty( $_GET['state'] ) || ! $provider->validateState( $_GET['state'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			wp_die( esc_html__( 'Could not verify the validity of the OAuth server\'s response. You should close this page and try again. If this problem persists contact the site administrator.', 'mw-oauth' ) );
		}

		try {
			// Try to get an access token using the authorization code grant.
			$access_token = $provider->getAccessToken(
				'authorization_code',
				array(
					'code' => $_GET['code'], // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				)
			);

			$user = $provider->getResourceOwner( $access_token );

			// This allows a loose connection to the function that actually performs
			// the login of an authetication. By default, it fires self::login_user(2);
			do_action( 'mw_oauth_login_user', $user );

		} catch ( IdentityProviderException | UnexpectedValueException $e ) {
			// Failed to get the access token or user details for some reason.
			$this->error_bag['oauth_error'] = $e->getMessage();
		}
	}

	/**
	 *
	 * @return void
	 */
	public function render_login_button(): void {
		if ( Factory::instance()->is_ready() ) {
			$action   = sprintf( '%s?action=%s', wp_login_url(), Helpers::PLUGIN_SLUG );
			$url      = wp_nonce_url( $action, Helpers::PLUGIN_SLUG . '_begin' );
			$position = 'top'; // @todo: provide this as an option in the plugin settings

			$output  = '<div class="mw-sso-login mw-sso-login--' . esc_attr( $position ) . '">';
			$output .= '	<a class="button button-large" href="' . esc_url( $url ) . '">' . esc_html__( 'Login with MediaWiki' ) . '</a>';
			$output .= '	<span class="mw-sso-login__or">' . esc_html__( 'Or', 'mw-oauth' ) . '</span>';
			$output .= '</div>';

			if ( 'top' === $position ) {
				add_action( 'login_footer', array( $this, 'output_button_position_script' ), 100 );
			}
			echo apply_filters( 'mw_oauth_login_button_html', $output, $url ); // phpcs:ignore
		}
	}

	/**
	 * Adds local error bag to the global WP Login WP_Error object
	 *
	 * @param WP_Error $errors
	 * @return WP_Error
	 */
	public function render_login_errors( WP_Error $errors ): WP_Error {
		foreach ( $this->error_bag as $code => $message ) {
			$errors->add( $code, sprintf( '<strong>%s</strong> %s', __( 'SSO Error:' ), $message ) );
		}

		return $errors;
	}

	/**
	 * Outputs Javascript snippet that will move SSO button to the top
	 * of the login form
	 *
	 * @return void
	 */
	public function output_button_position_script(): void {
		?>
			<script type="text/javascript">
				jQuery('.mw-sso-login').prependTo('#loginform')
			</script>
		<?php
	}

	/**
	 * @param WP_User? $user
	 * @return void
	 */
	public static function login_user( WP_User $user ): void {
		wp_clear_auth_cookie();
		wp_set_current_user( $user->ID );
		wp_set_auth_cookie( $user->ID, apply_filters( 'mw_oauth_remember_me', '__return_true' ) );

		$redirect_url = Helpers::option( 'redirect_url', '/' );

		if ( ! $redirect_url || strlen( $redirect_url ) <= 0 ) {
			$redirect_url = '/';
		}

		wp_safe_redirect( $redirect_url );
		die;
	}
}
