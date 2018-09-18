<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    if ($settings['view']['type']=='php') {
	    $view = new Slim\Views\PhpRenderer($settings['view']['template_path']);
    } else if($settings['view']['type']=='twig') {
	    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
	    // Add extensions
	    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
	    $view->addExtension(new Twig_Extension_Debug());
	    
    } else {
    	throw new Exception("Error View Render", 1);  	
    }
    return $view;
};


// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------
$container[App\Action\HomeAction::class] = function ($c) {
    return new App\Action\HomeAction($c->get('view'), $c->get('logger'));
};