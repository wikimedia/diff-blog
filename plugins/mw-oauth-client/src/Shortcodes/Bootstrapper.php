<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth\Shortcodes;

/**
 * Loads and contains all the shortcodes registered for this
 * plugin
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright   Wikimedia Foundation
 */
class Bootstrapper {
	/**
	 * @var array(string)
	 */
	protected $shortcodes = array(
		'MW_SSO_Login_Button',
	);

	/**
	 * @var array(ShortcodeAbstract)
	 */
	protected $instances = array();

	public function __construct() {
		if ( empty( $this->shortcodes ) ) {
			return $this;
		}

		foreach ( $this->shortcodes as $shortcode ) {
			$class = sprintf( '%s\%s', __NAMESPACE__, $shortcode );

			if ( class_exists( $class ) ) {
				$this->instances = new $class();
			}
		}
	}
}
