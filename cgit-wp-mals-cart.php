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

define('CGIT_MALS_CART_PLUGIN_FILE', __FILE__);

require __DIR__ . '/src/autoload.php';
require __DIR__ . '/activation.php';

/**
 * Load plugin
 *
 * This uses the plugins_loaded action to control the order in which plugins are
 * loaded. This plugin depends on the Product Catalogue, so must be loaded after
 * that plugin.
 */
add_action('plugins_loaded', function() {
    require __DIR__ . '/constants.php';
    require __DIR__ . '/functions.php';

    // Initialization
    MalsCart::getInstance();
}, 20);
