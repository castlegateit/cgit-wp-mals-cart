<?php

$cart = Cgit\MalsCart::getInstance();
$contents = $cart->contents();

if ($contents) {
    $items = $contents['quantity'] > 1 ? 'items' : 'item';
    $price = $cart::formatCurrency($contents['total']);

    echo '<p>' . $contents['quantity'] . ' ' . $items . ': ' . $price . '</p>';
}

?>
<div class="mals-cart-view">
    <form action="<?= $cart->urls['view'] ?>" method="post">

        <input type="hidden" name="userid" value="<?= CGIT_MALS_CART_ID ?>" />
        <input type="hidden" name="return" value="<?= $cart->urls['return'] ?>" />

        <p>
            <button>View Cart</button>
        </p>

    </form>
</div>
