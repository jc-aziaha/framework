<?php

use App\Zion\Routing\Router;
use App\Controller\WelcomeController;
use App\Controller\Error\ErrorController;
use Symfony\Component\HttpFoundation\Request;

    return [

        Request::class  => Request::createFromGlobals(),

        Router::class   => DI\create()->constructor(),

        'controllers'   => [
            "WelcomeController" => WelcomeController::class,
            "ErrorController"   => ErrorController::class,
        ],

    ];