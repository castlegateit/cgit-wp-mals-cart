# Castlegate IT WP Mal's Cart #

The Castlegate IT WP Mal's Cart plugin extends the [Product Catalogue](http://github.com/castlegateit/cgit-wp-product-catalogue) plugin to include [Mal's Ecommerce](http://www.mals-e.com/) integration. It supports all the features of the Product Catalogue plugin, including discounts and product variants.

You must define two constants in `wp-config.php` for the plugin to work:

*   `CGIT_MALS_CART_ID` is your Mal's account ID.
*   `CGIT_MALS_CART_URL` is the URL of your Mal's account server.

If your Mal's account is set to send back `GET` or `POST` requests when you click on the "continue shopping" link in the cart, the plugin will keep track of and display the number of items and the total price of all the items in the cart.

## Widgets ##

The plugin provides two widgets: Cart Contents and Add to Cart. The Add to Cart widget will only appear on single product pages. These plugins use `$cart->render('contents')` and `$cart->render('add')` respectively; see methods below for customization options.

## Functions ##

The plugin provides a single function `cgit_mals_cart()`, which retrieves the cart object. The object uses a singleton pattern, which means it can only have one instance.

    $cart = cgit_mals_cart();
    $cart = Cgit\MalsCart::getInstance(); // same as above

## Methods ##

The `Cgit\MalsCart` object provides various methods:

*   `$cart->render($view)` returns the compiled output of a PHP file from the `views` directory within the plugin. There are two views: `contents` and `add`, which are used by the widgets to render content.

*   `$cart->updateContents()` updates the contents stored in the local session based on `GET` or `POST` requests from Mal's Cart.

*   `$cart->contents()` returns the cart contents from the stored session, or an empty array if the cart is empty.

*   `$cart::formatCurrency($number, $after = false, $sep = '')` is the same as the `formatCurrency` method in the `Cgit\ProductCatalogue` class.

## Session ##

The cart contents are stored locally as an array in `$_SESSION['cart']`. A cart might something like:

    $_SESSION = array(
        'quantity' => 4, // number of items in cart
        'total' => 12.80, // total price of all items in cart
    );

## Filters ##

The `$cart->render()` method provides filters called `cgit_product_render_{name}`, where `{name}` is `contents` or `add`. These filters allow you to edit or replace the default output. The filter allows a second argument, which includes the cart contents (`$cart->contents()`).
