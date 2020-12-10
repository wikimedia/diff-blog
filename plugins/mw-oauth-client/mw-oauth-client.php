<?php
/**
 * The main file for the MediaWiki OAuth Client plugin. Included by WordPress during the bootstrap process.
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     Proprietary
 * @copyright   MediaWiki
 *
 * @wordpress-plugin
 * Plugin Name:         MediaWiki OAuth Client
 * Plugin URI:
 * Description:         Provides SSO between your WordPress site and any MediaWiki application with the OAuth extension enabled
 * Author:              Brad Morris (Codeable)
 * Author URI:          https://codeable.io/developers/brad-morris/
 *
 * Version:             1.1.0
 * Requires at least:   4.2
 * Tested up to:        5.4
 *
 * Text Domain:         mw-oauth
 * Domain Path:         /lang/
 */
namespace MW\WPOAuth;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const PLUGIN_VERSION = '1.1.0';
const PLUGIN_FILE    = __FILE__;
const PLUGIN_SLUG    = 'mw-oauth-client';

// Include autoloader.
require_once __DIR__ . '/vendor/autoload.php';

add_action( 'plugins_loaded', array( Factory::class, 'create' ) );
