<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth;

use MW\WPOAuth\Factory;

/**
 * Factory to return the shared plugin instance in addition
 * to enforcing dependencies
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     Proprietary
 * @copyright   Wikimedia Foundation
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
			return false;
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
