<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth\Admin;

use MW\WPOAuth\Controller as RootController;

/**
 * [Description SettingsController]
 */
final class Controller {
	public function __construct( RootController $controller ) {
		new Settings();
	}
}

