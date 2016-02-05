<?php

namespace Cgit\Products;

/**
 * Product cart
 *
 * The product cart extends the Cgit\Products\Utilities class, which provides
 * basic methods for rendering views and formatting currency values.
 */
class MalsCart extends Utilities
{

    /**
     * Reference to the singleton instance of the class
     */
    private static $instance;

    /**
     * Mal's Cart action URLs
     *
     * These are modified in the constructor to use the correct Mal's Cart
     * server numbers.
     */
    public $urls = array(
        'add' => '//ww#.aitsafe.com/cf/add.cfm',
        'view' => '//ww#.aitsafe.com/cf/review.cfm',
        'return' => '',
    );

    /**
     * Constructor
     *
     * Private constructor ...
     */
    private function __construct()
    {
        // Start session to store cart contents
        session_start();

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Set view path
        $this->viewPath = self::pluginDir(__FILE__) . '/views';

        // Set account URLs
        $this->updateUrls();

        // Update cart contents
        $this->updateContents();

        // Register widgets
        add_action('widgets_init', [$this, 'registerWidgets']);
    }

    /**
     * Return the singleton instance of the class
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Update URLs
     *
     * Each Mal's Cart uses a different numbered server. This method updates the
     * URL properties to use the numbered server from CGIT_MALS_CART_URL. It
     * also sets the return URL to the URL of the current page in WordPress.
     */
    private function updateUrls()
    {
        // Set cart URLs
        $pattern = '/^(?:https?:\/\/)?ww(\d+).*/';
        $match = preg_match($pattern, CGIT_MALS_CART_URL, $matches);
        $number = $matches[1];

        foreach ($this->urls as $key => $value) {
            $this->urls[$key] = str_replace('#', $number, $value);
        }

        // Set return URL to current URL
        $this->urls['return'] = home_url(add_query_arg(array()));
    }

    /**
     * Get cart contents
     *
     * Retrieves the cart contents stored in the local session, but does not get
     * any data from Mal's Cart itself.
     */
    public function contents()
    {
        return $_SESSION['cart'];
    }

    /**
     * Update cart contents
     *
     * If GET or POST requests are received from Mal's Cart, this method updates
     * the cart contents stored in the local session.
     */
    public function updateContents()
    {
        if (!isset($_REQUEST['qty'])) {
            return;
        }

        if ((int) $_REQUEST['qty'] == 0) {
            $_SESSION['cart'] = array();
            return;
        }

        $_SESSION['cart']['quantity'] = (int) $_REQUEST['qty'];
        $_SESSION['cart']['total'] = (float) $_REQUEST['tot'];
    }

    /**
     * Register widgets
     */
    public function registerWidgets()
    {
        register_widget('Cgit\Products\MalsCartContentsWidget');
        register_widget('Cgit\Products\MalsCartAddWidget');
    }

}
