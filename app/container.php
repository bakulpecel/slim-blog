<?php

$container = $app->getContainer();

// Elloquent
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($c) use ($capsule) {
    return $capsule;
};

// Twig View
$container['view'] = function ($c) {
    $settings = $c->get('settings');

    $view = new Slim\Views\Twig(
        $settings['view']['template_path'],
        $settings['view']['twig']
    );
    $view->addExtension(new Slim\Views\TwigExtension(
        $c->get('router'),
        $c->get('request')->getUri())
    );
    $view->addExtension(new Twig_Extension_Debug());
    $view->getEnvironment()->addGlobal('old', $_SESSION['old']);
    unset($_SESSION['old']);

    $view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
    unset($_SESSION['errors']);

    return $view;
};

// Validator
$container['validator'] = function ($c) {
    $settings = $c->get('settings');

    $params = $c['request']->getParams();

    return new Valitron\Validator($params, [], $settings['lang']['default']);
};