<?php

use Twig\Environment;
use App\Zion\Routing\Router;
use Twig\Loader\FilesystemLoader;
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

        Environment::class => function () {
            $loader = new FilesystemLoader(__DIR__ . "/../templates");
            return new Environment($loader);
        }

    ];