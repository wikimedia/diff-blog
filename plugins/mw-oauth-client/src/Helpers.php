<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth;

/**
 * Contains Helpers
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
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
	/**
	 * @param string $handle
	 * @param string $src
	 * @param array $deps
	 * @return void
	 */
	public static function enqueue_style( string $handle, string $src, array $deps = array() ): void {
		wp_enqueue_style( PLUGIN_SLUG . '-' . $handle, static::plugins_url( $src ), $deps, time() );
	}

	/**
	 * @param string $handle
	 * @param string $src
	 * @param array $deps
	 * @param bool $in_footer
	 * @return void
	 */
	public static function enqueue_script( string $handle, string $src, array $deps, $in_footer = true ): void {
		wp_enqueue_script( PLUGIN_SLUG . '-' . $handle, static::plugins_url( $src ), $deps, time(), $in_footer );
	}

	/**
	 * @param string $file
	 * @return string
	 */
	public static function plugins_url( string $file ): string {
		return plugins_url( '/assets/' . $file, PLUGIN_FILE );
	}
}
