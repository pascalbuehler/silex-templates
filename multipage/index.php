<?php
// REQUIRE
// Load what we need ...
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/classes/Config.class.php';
require_once __DIR__.'/classes/ControllerResolver.class.php';

// SECURITY
// Unset PHP_SELF because it allows SQL-Injection and Cross-Site-Scripting
unset($PHP_SELF);
unset($_SERVER['PHP_SELF']);

// TIMEZONE
date_default_timezone_set('UTC');

// CONFIG
$config = Config::getInstance();
$pages = $config->getPages();

// SILEX
// Init
$app = new Silex\Application();
$app['debug'] = true;

// Add ControllerResolver
$app['resolver'] = function ($app) {
    return new ControllerResolver($app);
};

// Add Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/templates', // The path to the templates, which is in our case points to /var/www/templates
));

// Routes for the pages
foreach($pages as $pageName) {
    $pageConfig = $config->getPageConfig($pageName);
    require_once __DIR__.'/controllers/HomeController.class.php';
    
    $x = $app->get(strtolower($pageConfig['route']), $pageConfig['controller'].'::'.$pageConfig['controllermethod'])
        ->bind($pageConfig['name'])
        ->after(function($request, $response) use($app, $pageConfig) {
            $data = $app[$pageConfig['controller'].'.'.$pageConfig['controllermethod'].'.data'];
            $content =  $app['twig']->render($pageConfig['template'], $data);
            $response->setContent($content);
            return $response;
        });
//    $app->get(strtolower($pageConfig['route']), function (Silex\Application $app) use($config, $pageConfig) { 
//        return $app['twig']->render(
//            $pageConfig['template'],
//            array('version' => $config->get('version'))
//        );
//    })->bind($pageConfig['name']);
}

// Run
$app->run();
