<?php
class Config {
    const VERSION = '1.0';
    
    private static $instance = null;
    
    /** Configuration values */
    private $config = array(
        'version' => self::VERSION,
        'pages' => array(
            'Home' => array(
                'name' => 'Home',
                'template' => 'pages/home.twig'
            ),
            'Products' => array(
                'name' => 'Products',
                'template' => 'pages/products.twig'
            ),
            'About' => array(
                'name' => 'About',
                'template' => 'pages/about.twig'
            ),
        )
    );

    /** Pages */
    private $pages = array(
        'Home' => array(
            'name' => 'Home',
            'route' => '/',
            'controller' => 'HomeController',
            'controllermethod' => 'home',
            'template' => 'pages/home.twig'
        ),
        'Products' => array(
            'name' => 'Products',
            'route' => '/products',
            'controller' => 'ProductsControler',
            'controllermethod' => 'products',
            'template' => 'pages/products.twig'
        ),
        'About' => array(
            'name' => 'About',
            'route' => '/about',
            'controller' => 'AboutController',
            'controllermethod' => 'about',
            'template' => 'pages/about.twig'
        ),
    );
    
    /* ################
     * # CONSTRUCTORS #
     * ################ */
    /**
     * Creates a new instance.
     */
    protected function __construct() {
    }
    
    /**
     * Clone is prohibited!
     */
    private function __clone() {
    }

    /* ###########
     * # METHODS #
     * ########### */
    /**
     * Gets an instance of this class (Singleton)
     * 
     * @return Config The configuration object
     */
    public static function getInstance() {
        if(self::$instance==null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }
    
    /**
     * Gets a configuration value.
     * 
     * @param string $name The name of the configuration
     * @return mixed The requested configuration value or FALSE on error
     */
    public function get($name) {
        $value = false;
        if(isset($this->config[$name])) {
            $value = $this->config[$name];
        }
        return $value;
    }

    /**
     * Gets all configuration values.
     * 
     * @return array All configuration values in an array
     */
    public function getAll() {
        return $this->config;
    }
    
    /**
     * Gets all pages.
     * 
     * @return array All pages
     */
    public function getPages() {
        return array_keys($this->pages);
    }    

    /**
     * Gets the configuration of a page
     * 
     * @param string $pageName The name of the page
     * @return mixed The requested page configuration or FALSE on error
     */
    public function getPageConfig($pageName) {
        $value = false;
        if(isset($this->pages[$pageName])) {
            $value = $this->pages[$pageName];
        }
        return $value;
    }    
}
