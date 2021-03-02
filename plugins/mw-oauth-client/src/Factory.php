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

use MW\WPOAuth\Factory;

/**
 * Factory to return the shared plugin instance in addition
 * to enforcing dependencies
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 */
class Factory {

	/**
	 * @var MW\WPOAuth $instance
	 * @since 1.0.0
	 * @access private
	 */
	private static $instance = null;

	/**
	 * Singleton Factory Accessor
	 *
	 * @return MW\WPOAuth\Controller
	 * @since 1.0.0
	 * @access public
	 */
	public static function create() {
		if ( ! static::passes_dependency_check() ) {
			add_action( 'admin_notices', array( static::class, 'dependency_not_met_notice' ) );
			return;
		}

		return static::instance();
	}

	/**
	 * @return MW\WPOAuth\Controller
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Controller ) ) {
			self::$instance = new Controller();
		}

		return self::$instance;
	}
	/**
	 * Prevent cloning of a singleton object
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'edd_dow' ), '1.0' ); // phpcs:ignore
	}

	/**
	 * Prevent unserializing of a singleton class.
	 *
	 * There should be no reason this class is ever serialized.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'edd_dpw' ), '1.0' ); // phpcs:ignore
	}

	/**
	 * Logical test for required dependencies
	 *
	 * @return bool
	 * @since 1.0.0
	 * @access protected
	 */
	protected static function passes_dependency_check(): bool {
		return true;
	}

	/**
	 * This function is used to throw an admin notice when the WordPress install
	 * does not contain the required dependencies
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public static function dependency_not_met_notice(): void {
		?>
		<?php
	}
}

function mw_oauth_client(): Controller {
	return Factory::instance();
}
