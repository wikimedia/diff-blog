<?php
/**
 * Hi there, VIP dev!
 *
 * vip-config.php is where you put things you'd usually put in wp-config.php. Don't worry about database settings
 * and such, we've taken care of that for you. This is just for if you need to define an API key or something
 * of that nature.
 *
 * WARNING: This file is loaded very early (immediately after `wp-config.php`), which means that most WordPress APIs,
 *   classes, and functions are not available. The code below should be limited to pure PHP.
 *
 * @see https://vip.wordpress.com/documentation/vip-go/understanding-your-vip-go-codebase/
 *
 * Happy Coding!
 *
 * - The WordPress.com VIP Team
 **/

if ( isset( $_SERVER['HTTP_HOST'] ) ) {
    $http_host   = $_SERVER['HTTP_HOST'];
    $request_uri = $_SERVER['REQUEST_URI'];

    $redirect_to_domain = 'diff.wikimedia.org';
    $redirect_domains   = [
        'blog.wikimedia.org',
    ];

    // Safety checks for redirection:
    // 1. Don't redirect for '/cache-healthcheck?' or monitoring will break
    // 2. Don't redirect in WP CLI context
    if (
            '/cache-healthcheck?' !== $request_uri && // safety
            ! ( defined( 'WP_CLI' ) && WP_CLI ) && // safety
            $redirect_to_domain !== $http_host && in_array( $http_host, $redirect_domains, true )
        ) {
        header( 'Location: https://' . $redirect_to_domain . $request_uri, true, 301 );
        exit;
    }
}
