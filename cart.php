<?php

namespace Cgit;

/**
 * Product cart
 *
 * The product cart extends the Cgit\ProductUtil class, which provides
 * basic methods for rendering views and formatting currency values.
 */
class MalsCart extends ProductUtil
{

    /**
     * Reference to the singleton instance of the class
     */
    private static $instance;

    /**
     * Mal's Cart action URLs
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
        // Set view path
        $this->viewPath = dirname(__FILE__) . '/views';

        // Set account URLs
        $this->updateUrls();
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
     * URL properties to use the numbered server from CGIT_MALS_CART_URL.
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
}
