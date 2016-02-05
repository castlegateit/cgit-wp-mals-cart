<?php

/*

Plugin Name: Castlegate IT WP Mal&rsquo;s Cart
Plugin URI: http://github.com/castlegateit/cgit-wp-mals-cart
Description: Mal&rsquo;s Cart integration for the Product Catalogue plugin.
Version: 1.0
Author: Castlegate IT
Author URI: http://www.castlegateit.co.uk/
License: MIT

*/

use Cgit\Products\MalsCart;

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

    require __DIR__ . '/src/autoload.php';
    require __DIR__ . '/activation.php';
    require __DIR__ . '/functions.php';

    // Initialization
    MalsCart::getInstance();
}, 20);
