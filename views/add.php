<?php

if (!is_singular(CGIT_PRODUCT_POST_TYPE)) {
    return;
}

global $post;

$product = new Cgit\Product($post->ID);
$cart = Cgit\MalsCart::getInstance();

?>
<div class="mals-cart-add">
    <form action="<?= $cart->urls['add'] ?>" method="post">

        <input type="hidden" name="userid" value="<?= CGIT_MALS_CART_ID ?>" />
        <input type="hidden" name="product[]" value="<?= $product->post_title ?>" />
        <input type="hidden" name="price" value="<?= $product->product_price ?>" />
        <input type="hidden" name="return" value="<?= get_permalink($product->ID) ?>" />

        <p>
            <label for="mals_cart_quantity">Quantity</label>
            <input type="number" name="qty" id="mals_cart_quantity" value="1" />
        </p>

        <?php

        if ($product->product_variants) {
            ?>
            <p>
                <label for="mals_cart_variant">Variant</label>
                <select name="product[]" id="mals_cart_variant">
                <?php

                foreach ($product->product_variants as $key => $variant) {
                    $selected = '';

                    if (
                        isset($_POST['cart_variant']) &&
                        $_POST['cart_variant'] == $key
                    ) {
                        $selected = ' selected';
                    }

                    ?>
                    <option value="<?= $variant['variant_name'] ?>"<?= $selected ?>><?= $variant['variant_name'] ?></option>
                    <?php
                }

                ?>
                </select>
            </p>
            <?php

        }

        ?>

        <p>
            <button>Add to Cart</button>
        </p>

    </form>
</div>
