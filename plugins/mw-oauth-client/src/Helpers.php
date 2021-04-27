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

namespace MW\WPOAuth;

/**
 * Contains Helpers
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
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
		wp_enqueue_style( PLUGIN_SLUG . '-' . $handle, self::plugins_url( $src ), $deps, time() );
	}

	/**
	 * @param string $handle
	 * @param string $src
	 * @param array $deps
	 * @param bool $in_footer
	 * @return void
	 */
	public static function enqueue_script( string $handle, string $src, array $deps, $in_footer = true ): void {
		wp_enqueue_script( PLUGIN_SLUG . '-' . $handle, self::plugins_url( $src ), $deps, time(), $in_footer );
	}

	/**
	 * @param string $file
	 * @return string
	 */
	public static function plugins_url( string $file ): string {
		return plugins_url( '/assets/' . $file, PLUGIN_FILE );
	}
}
