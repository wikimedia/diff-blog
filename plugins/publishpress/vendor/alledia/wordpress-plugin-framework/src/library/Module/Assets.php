<?php

namespace Allex\Module;

use Allex\Container;

class Assets extends Abstract_Module
{
    /**
     * @var string
     */
    protected $assets_base_url;

    /**
     * @var string
     */
    protected $version;

    /**
     * Assets constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->assets_base_url = $this->container['ASSETS_BASE_URL'];
        $this->version         = $this->container['VERSION'];
    }

    /**
     * Initialize the module loading the hooks.
     */
    public function init()
    {
        $this->init_hooks();
    }

    /**
     * Initialize the hooks.
     */
    protected function init_hooks()
    {
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_styles']);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
    }

    /**
     * Enqueue styles for the admin UI.
     */
    public function admin_enqueue_styles()
    {
        wp_enqueue_style(
            'allex',
            $this->assets_base_url . '/css/allex-admin.css',
            ['allex-font-awesome', 'allex-grid'],
            $this->version
        );

        wp_enqueue_style(
            'allex-grid',
            $this->assets_base_url . '/css/allex-grid.min.css',
            [],
            $this->version
        );

        wp_enqueue_style(
            'allex-font-awesome',
            $this->assets_base_url . '/lib/font-awesome-v5.2.0/css/all.min.css',
            [],
            $this->version
        );
    }

    /**
     * Enqueue scripts for the admin UI.
     */
    public function admin_enqueue_scripts()
    {
        global $wp_scripts;

        if (!isset($wp_scripts->queue['react'])) {
            wp_enqueue_script(
                'react',
                "{$this->assets_base_url}/lib/react.min.js",
                [],
                $this->version
            );
            wp_enqueue_script(
                'react-dom',
                "{$this->assets_base_url}/lib/react-dom.min.js",
                ['react'],
                $this->version
            );
        }

        wp_enqueue_script(
            'allex-admin-addons',
            "{$this->assets_base_url}/js/admin-addons.min.js",
            ['jquery', 'react', 'react-dom'],
            $this->version
        );

        wp_enqueue_script(
            'allex',
            $this->assets_base_url . '/js/allex-admin.js',
            ['jquery', 'react'],
            $this->version
        );

        wp_localize_script(
            'allex-admin-addons',
            'allexContext',
            [
                'labels' => [
                    'installed'                          => __('Installed Extensions', 'allex'),
                    'browse_more'                        => __('Browse More Extensions', 'allex'),
                    'enter_license_key'                  => __('Enter your license key', 'allex'),
                    'activate'                           => __('Activate', 'allex'),
                    'license_key'                        => __('License Key', 'allex'),
                    'change'                             => __('Change', 'allex'),
                    'get_plugins'                        => __('Get Pro Add-ons!', 'allex'),
                    'please_wait'                        => __('Please, wait...', 'allex'),
                    'empty_license'                      => __('Please, enter a license key.', 'allex'),
                    'contact_support'                    => __(
                        'If the error persists, please contact the support team.',
                        'allex'
                    ),
                    'all_plugins_installed'              => __(
                        'Awesome, it seems like you have all the add-ons installed. Thank you for supporting us.',
                        'allex'
                    ),
                    'license_status_invalid'             => __('Invalid license', 'allex'),
                    'license_status_valid'               => __('Activated', 'allex'),
                    'license_status_missing'             => __('This license key was not found.', 'allex'),
                    'license_status_disabled'            => __('This license key is disabled.', 'allex'),
                    'license_status_expired'             => __('This license key has expired.', 'allex'),
                    'license_status_no_activations_left' => __(
                        'This license key has no activations left. Please, consider upgrading your plan.',
                        'allex'
                    ),
                ],
            ]
        );
    }
}
