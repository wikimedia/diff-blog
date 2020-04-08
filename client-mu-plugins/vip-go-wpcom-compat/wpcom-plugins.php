<?php

/**
 * Loads a plugin on VIP Go, with compatability for the way things were done on WPcom.
 * Compatability for both WPcom's deprecated plugin versioning and the deprecated folder locations (theme & plugin).
 *
 * @param string $plugin Optional. Folder name of the plugin, or the folder and plugin file name (such as wp-api/plugin.php), relative to WP_PLUGIN_DIR.
 * @param string $folder Subdirectory of WP_PLUGIN_DIR to load plugin from.
 * @param string $version Optional. Specify which version of the plugin to load. Version should be in the format 1.0.0.
 *
 * @return bool True if the include was successful.
 */
function wpcom_vip_legacy_load_plugin( $plugin = false, $folder = false, $version = false ) {
	if ( is_string( $version ) && false !== $plugin ) {
		$plugin = "$plugin-$version/$plugin.php";
	}

	if ( in_array( $folder, [ 'theme', 'plugins' ], true ) ) {
		$folder = false;
	}

	return wpcom_vip_load_plugin( $plugin, $folder );
}

/**
 * Fix plugin url paths when relative to the theme's directory.
 *
 * In plugins_url(), plugin_basename() enforces a directory relative to WP_PLUGIN_DIR or WPMU_PLUGIN_DIR.
 * This doesn't work out well in cases where "plugins" are still being used in themes/theme-name/plugins.
 *
 * @see https://developer.wordpress.org/reference/functions/plugins_url/
 */
function vip_wpcom_compat_allow_plugins_url_inside_themes( $final_url, $requested_file, $relative_file_path ) {
	$themes_dir = WP_CONTENT_DIR . '/themes';
	$themes_url = content_url( 'themes' );

	// Check if a path from inside a theme is being requested.
	if ( 0 === strpos( $relative_file_path, $themes_dir ) ) {
		// Switch out the theme file's base path with a URL friendly version.
		$new_url_base = str_replace( $themes_dir, $themes_url, dirname( $relative_file_path ) );

		// Use that new URL as a base to serve the requested file.
		$final_url = trailingslashit( $new_url_base ) . ltrim( $requested_file, '/\\' );
	}

	return $final_url;
}
add_filter( 'plugins_url', 'vip_wpcom_compat_allow_plugins_url_inside_themes', 100, 3 );

// Enables the Writing Helper plugin that is a part of WordPress.com but not Jetpack.
if ( true === apply_filters( 'wpcom_compat_enable_writing_helper', true ) && ! class_exists( 'Writing_Helper' ) ) {
	require __DIR__ . '/plugins/writing-helper/writing-helper.php';
}

require_once __DIR__ . '/plugins/mrss.php';
