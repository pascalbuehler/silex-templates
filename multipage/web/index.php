<?php
// REQUIRE
// Load what we need ...
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/classes/ControllerResolver.class.php';

// SECURITY
// Unset PHP_SELF because it allows SQL-Injection and Cross-Site-Scripting
unset($PHP_SELF);
unset($_SERVER['PHP_SELF']);

// ERROR REPORTING
error_reporting(E_ALL);
ini_set('dislay_errors', 1);

// TIMEZONE
date_default_timezone_set('UTC');

// SILEX
// Init
$app = new Silex\Application();

// Add ControllerResolver
$app['resolver'] = function($app) {
    return new ControllerResolver($app);
};

// Add Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../resources/templates',
));
$app['twig'] = $app->extend('twig', function (\Twig_Environment $twig, \Silex\Application $app) {
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        $base = $app['request_stack']->getCurrentRequest()->getBasePath();

        return sprintf($base.'/'.$asset, ltrim($asset, '/'));
    }));
    return $twig;
});

// Forms
use Silex\Provider\FormServiceProvider;
$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

// Translations
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale' => 'en',
    'translator.domains' => array(),
));
$app['translator']->setLocale('en');

// Load config
use Lokhman\Silex\Config\ConfigServiceProvider;
$app->register(new ConfigServiceProvider(__DIR__ . '/../config'));
$app->extend('twig', function($twig, $app) {
    $twig->addGlobal('version', $app['version']);
    $twig->addGlobal('pages', $app['pages']);
    return $twig;
});

// Routes for the pages
foreach($app['pages'] as $pageConfig) {
    require_once __DIR__.'/../src/controllers/'.$pageConfig['controller'].'.class.php';
    $x = $app->$pageConfig['method'](strtolower($pageConfig['route']), $pageConfig['controller'].'::'.$pageConfig['controllermethod'])
        ->bind($pageConfig['name'])
        ->after(function($request, $response) use($app, $pageConfig) {
            $data = $app[$pageConfig['controller'].'.data'];
            $data['currentPageId'] = $pageConfig['id'];
            $data['currentParentPageId'] = $pageConfig['parentid'];
            $content =  $app['twig']->render($pageConfig['template'], $data);
            $response->setContent($content);
            return $response;
        });
}

// Run
$app->run();
