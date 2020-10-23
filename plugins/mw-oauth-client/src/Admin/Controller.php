<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth\Admin;

use MW\WPOAuth\Controller as RootController;

/**
 * Bootstraps the Admin Services
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     Proprietary
 * @copyright   Wikimedia Foundation
 */
final class Controller {
	public function __construct( RootController $controller ) {
		new Settings();
	}
}
