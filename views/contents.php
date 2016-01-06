<?php

$cart = cgit_mals_cart();

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
