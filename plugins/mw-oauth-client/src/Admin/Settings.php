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

namespace MW\WPOAuth\Admin;

use MW\WPOAuth\Helpers;

/**
 * Registers and renders all of the admin settings API fields used in this plugin
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 */
final class Settings {

	/**
	 * @var string
	 */
	protected $key;

	/**
	 * Class Constructor
	 */
	public function __construct() {
		$this->key = str_replace( '-', '_', Helpers::PLUGIN_SLUG );

		add_action( 'admin_menu', array( $this, 'register_settings_page' ), 10 );
		add_action( 'admin_init', array( $this, 'settings_init' ), 10 );
	}

	/**
	 * @return void
	 */
	public function register_settings_page(): void {
		$hook = add_options_page(
			__( 'MediaWiki SSO' ),
			__( 'MediaWiki SSO' ),
			'manage_options',
			Helpers::PLUGIN_SLUG,
			array( $this, 'render_settings_page' )
		);

		if ( $hook ) {
			add_action( 'load-' . $hook, array( SettingsContextualHelp::class, 'add_contextual_help_tab' ) );
		}
	}

	/**
	 * @return void
	 */
	public function settings_init(): void {

		register_setting( $this->key, $this->key );

		add_settings_section(
			$this->key . '__general',
			__( 'General Settings', 'mw-oauth' ),
			null,
			$this->key
		);

		add_settings_field(
			'new_user_role',
			__( 'New User Role', 'mw-oauth' ),
			array( $this, 'render_new_user_role_field' ),
			$this->key,
			$this->key . '__general'
		);

		add_settings_field(
			'redirect_url',
			__( 'Redirect Url', 'mw-oauth' ),
			array( $this, 'render_redirect_url_field' ),
			$this->key,
			$this->key . '__general'
		);

		add_settings_section(
			$this->key . '__credentials',
			__( 'Consumer Credentials', 'mw-oauth' ),
			array( $this, 'settings_section_callback' ),
			$this->key
		);

		add_settings_field(
			'wiki_url',
			__( 'REST API Address', 'mw-oauth' ),
			array( $this, 'render_wiki_url_field' ),
			$this->key,
			$this->key . '__credentials'
		);

		add_settings_field(
			'key',
			__( 'Key', 'mw-oauth' ),
			array( $this, 'render_key_field' ),
			$this->key,
			$this->key . '__credentials'
		);

		add_settings_field(
			'secret',
			__( 'Secret', 'mw-oauth' ),
			array( $this, 'render_secret_field' ),
			$this->key,
			$this->key . '__credentials'
		);
	}

	/**
	 * @return void
	 */
	public function render_new_user_role_field(): void {
		global $wp_roles;

		$options = get_option( $this->key );

		$value = isset( $options['new_user_role'] ) ? $options['new_user_role'] : false;

		echo sprintf(
			'<select type="text" name="%s[new_user_role]">',
			esc_attr( $this->key ),
		);

		foreach ( $wp_roles->roles as $key => $role ) {
			echo sprintf( '<option value="%s"%s>%s</option>', esc_attr( $key ), selected( $key, $value ), esc_html( $role['name'] ) );
		}

		echo '</select>';
	}

	/**
	 * @return void
	 */
	public function render_redirect_url_field(): void {
		$options = get_option( $this->key );

		$value = isset( $options['redirect_url'] ) ? $options['redirect_url'] : false;

		echo sprintf(
			'<input class="regular-text" type="text" name="%s[redirect_url]" value="%s">',
			esc_attr( $this->key ),
			esc_attr( $value )
		);
		echo '<p class="description">' . esc_html__( 'If left blank this will default to the homepage', 'mw-oauth' ) . '</p>';
	}

	/**
	 * @return void
	 */
	public function render_wiki_url_field(): void {
		$options = get_option( $this->key );

		$value = isset( $options['wiki_url'] ) ? $options['wiki_url'] : false;

		echo sprintf(
			'<input class="regular-text" type="text" name="%s[wiki_url]" value="%s">',
			esc_attr( $this->key ),
			esc_attr( $value )
		);
		echo '<p class="description">' . esc_html__( 'For most wikis this will be https://yourdomain/rest.php.', 'mw-oauth' ) . '</p>';

	}

	/**
	 * @return void
	 */
	public function render_key_field(): void {
		$options = get_option( $this->key );

		$value = isset( $options['key'] ) ? $options['key'] : false;

		echo sprintf(
			'<input class="regular-text" type="text" name="%s[key]" value="%s">',
			esc_attr( $this->key ),
			esc_attr( $value )
		);
	}

	/**
	 * @return void
	 */
	public function render_secret_field(): void {
		$options = get_option( $this->key );

		$value = isset( $options['secret'] ) ? $options['secret'] : false;

		echo sprintf(
			'<input class="regular-text" type="%s" name="%s[secret]" value="%s">',
			esc_attr( empty( $value ) ? 'text' : 'password' ),
			esc_attr( $this->key ),
			esc_attr( $value )
		);
	}

	/**
	 * @return void
	 */
	public function settings_section_callback(): void {
		echo esc_html__( 'The following details will be provided to you by MediaWiki when a new OAuth consumer is registered.', 'mw-oauth' );
	}

	/**
	 * @return void
	 */
	public function appearance_section_callback(): void {
		echo esc_html__( 'Control how the login button appears on the WordPress Login Screen', 'mw-oauth' );
	}

	/**
	 * @return void
	 */
	public function render_settings_page(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'MediaWiki SSO Settings', 'mw-oauth' ); ?></h1>
			<p class="description"><?php esc_html_e( 'Not sure what to enter on this page? Check the help tab in the top right of the page for more info', 'mw-oauth' ); ?></p>
			<form method="POST" action="options.php">
					<?php
					settings_fields( $this->key );
					do_settings_sections( $this->key );
					submit_button();
					?>
			</form>
		</div>
		<?php
	}
}
