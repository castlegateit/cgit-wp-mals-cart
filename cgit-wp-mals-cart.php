<?php

/*

Plugin Name: Castlegate IT WP Mal&rsquo;s Cart
Plugin URI: http://github.com/castlegateit/cgit-wp-mals-cart
Description: Mal&rsquo;s Cart integration for the Product Catalogue plugin.
Version: 0.1
Author: Castlegate IT
Author URI: http://www.castlegateit.co.uk/
License: MIT

*/

/**
 * ACF and Product Catalogue are required
 */
register_activation_hook(__FILE__, function() {
    if (
        !function_exists('acf_add_local_field_group') ||
        !function_exists('cgit_product')
    ) {
        $acf_url = 'http://www.advancedcustomfields.com/';
        $cat_url = 'http://github.com/castlegateit/cgit-wp-product-catalogue';
        $message = 'Plugin activation failed. The Mal&rsquo;s Cart plugin '
            . 'requires <a href="' . $acf_url . '">Advanced Custom Fields</a> '
            . 'and <a href="' . $cat_url . '">Product Catalogue</a>.'
            . '<br /><br /><a href="' . admin_url('/plugins.php')
            . '">Back to Plugins</a>';

        wp_die($message);
    }
});

/**
 * Load plugin
 *
 * This uses the plugins_loaded action to control the order in which plugins are
 * loaded. This plugin depends on the Product Catalogue, so must be loaded after
 * that plugin.
 */
add_action('plugins_loaded', function() {

    // Mal's Cart user ID is required
    if (!defined('CGIT_MALS_CART_ID') || !defined('CGIT_MALS_CART_URL')) {
        $message = 'Required constants missing. You must define '
            . '<code>CGIT_MALS_CART_ID</code> with your Mal&rsquo;s Cart ID '
            . 'and <code>CGIT_MALS_CART_URL</code> with your Mal&rsquo;s Cart '
            . ' URL. These should be defined in <code>wp-config.php</code>.';

        wp_die($message);
    }

    // Includes
    include dirname(__FILE__) . '/cart.php';
    include dirname(__FILE__) . '/functions.php';
    include dirname(__FILE__) . '/widgets.php';

    // Initialization
    Cgit\MalsCart::getInstance();
}, 20);
