<?php

/**
 * Provides simple backwards compatability with WordPress.com Protected Embeds.
 * This does NOT provide the "protection" of the protected embeds, just renders them.
 *
 * If a site wants to use a different protected embeds plugin, they can by calling
 * `remove_shortcode( 'protected-iframe' )` before loading the other plugin.
 */
function wpcom_compat_protected_iframe_shortcode( $attrs ) {
	$attrs = wp_parse_args(
		$attrs,
		array(
			'id' => null,
		)
	);

	$embed_table     = apply_filters( 'wpcom_protected_embed_table', 'wp_protected_embeds' );
	$embed_not_found = apply_filters( 'wpcom_protected_embed_not_found', '<!-- Embed not found -->' );

	if ( ! $attrs['id'] ) {
		return $embed_not_found;
	}

	$id    = $attrs['id'];
	$embed = wp_cache_get( $id, 'simple-protected-embeds' );

	if ( false === $embed ) {
		global $wpdb;

		$embed = $wpdb->get_row(
			$wpdb->prepare( "SELECT html FROM `$embed_table` WHERE `embed_id` = %s", $id )
		);

		if ( ! $embed ) {
			return $embed_not_found;
		}

		$embed = $embed->html;

		wp_cache_set( $id, $embed, 'simple-protected-embeds' );
	}

	return apply_filters( 'wpcom_protected_embed_html', $embed );
}
add_shortcode( 'protected-iframe', 'wpcom_compat_protected_iframe_shortcode' );
