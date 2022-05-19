<?php

use Twig\Environment;
use App\Zion\Routing\Router;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
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
        },

        EntityManager::class  => function() {

            $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
            $dotenv->load();

            $params = [
                'dbname'    => $_ENV['DBNAME'],
                'user'      => $_ENV['USER'],
                'password'  => $_ENV['PASSWORD'],
                'host'      => $_ENV['HOST'],
                'driver'    => $_ENV['DRIVER'],
            ];

            $paths = [__DIR__ . '/../src/Entity'];

            $ORMconfig      = Setup::createAttributeMetadataConfiguration($paths);
            $entityManager  = EntityManager::create($params, $ORMconfig);

            return $entityManager;
        }

    ];