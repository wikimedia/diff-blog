<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth;

/**
 * Contains Helpers
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     Proprietary
 * @copyright   Wikimedia Foundation
 */
final class Helpers {

	/**
	 * @var string
	 */
	const PLUGIN_SLUG = PLUGIN_SLUG;

	/**
	 * @var string
	 */
	const PLUGIN_VERSION = PLUGIN_VERSION;

	/**
	 * @var string
	 */
	const PLUGIN_FILE = PLUGIN_FILE;

	/**
	 * @return string
	 */
	public static function get_login_action_url(): string {
		$action = sprintf( '%s?action=%s', wp_login_url(), self::PLUGIN_SLUG );
		$url    = wp_nonce_url( $action, self::PLUGIN_SLUG . '_begin' );

		return apply_filters( 'mw_oauth_login_action_url', $url );
	}

	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public static function option( string $key, $default = false ) {
		$opts = get_option( 'mw_oauth_client', array() );

		return \array_key_exists( $key, $opts ) ? $opts[ $key ] : $default;
	}
}
