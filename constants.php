<?php

// Mal's Cart user ID is required
if (!defined('CGIT_MALS_CART_ID') || !defined('CGIT_MALS_CART_URL')) {
    $message = 'Required constants missing. You must define '
        . '<code>CGIT_MALS_CART_ID</code> with your Mal&rsquo;s Cart ID '
        . 'and <code>CGIT_MALS_CART_URL</code> with your Mal&rsquo;s Cart '
        . ' URL. These should be defined in <code>wp-config.php</code>.';

    wp_die($message);
}
