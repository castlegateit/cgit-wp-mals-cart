<?php

use Cgit\Products\MalsCart;

/**
 * Get cart object
 */
function cgit_mals_cart() {
    return MalsCart::getInstance();
}
