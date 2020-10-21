<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth\Admin;

use MW\WPOAuth\Helpers;

/**
 * Contains the actions and hooks to add contextual help to the SSO
 * Options page
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     Proprietary
 * @copyright   Wikimedia Foundation
 */
final class SettingsContextualHelp {
	/**
	 * @return void
	 */
	public static function add_contextual_help_tab(): void {
		$current_screen = get_current_screen();

		if ( $current_screen && 'settings_page_' . Helpers::PLUGIN_SLUG === $current_screen->id ) {
			$current_screen->add_help_tab(
				array(
					'id'       => Helpers::PLUGIN_SLUG . '_help',
					'title'    => __( 'SSO Configuration', 'mw-oauth' ),
					'callback' => array( static::class, 'render_help_tab' ),
				)
			);
		}
	}

	/**
	 * @return void
	 */
	public static function render_help_tab(): void {
		$callback_url = wp_login_url() . '?action=' . Helpers::PLUGIN_SLUG . '_callback';

		?>
		<h2>Registering an OAuth Consumer</h2>
			<p><?php echo wp_kses_post( __( 'This plugin can be used with any MediaWiki<small>&gt;1.35</small> installation that has the <a href="https://www.mediawiki.org/wiki/Extension:OAuth">OAuth extension</a> installed and correctly configured.', 'mw-outh' ) ); ?></p>
			<p><?php echo wp_kses_post( __( 'You will need to have an approved OAuth 2.0 consumer registered on the Wiki. Registering a consumer can be done by submitting a proposal on the <strong>Special:OAuthConsumerRegistration/propose</strong> page, and entering the following details exactly as shown:' ) ); ?></p>
			<dl>
				<dt>OAuth protocol version:</dt>
		<dd>OAuth 2.0</dd>
				<dt>OAuth "callback" URL:</dt>
		<dd><?php echo esc_html( $callback_url ); ?></dd>
				<dt>Types of grants being requested:</dt>
		<dd>User identity verification only with access to real name and email address, no ability to read pages or act on a user's behalf.</dd>
			</dl>
		<h2>General Settings</h2>
		<p>Where possible, you should use http<strong>s</strong>:// for your REST API address. The plugin will accept plain http, although this is strongly discouraged as it presents numerous security issues.</p>
		<?php
	}
}
