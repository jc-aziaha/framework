<?php

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

    /**
     * -------------------------------------------------------------------------
     * Bienvenue dans notre application
     * 
     * Ce fichier représente le FrontController
     * 
     * Ses tâches : 
     * 
     *      -- Charger le conteneur de services
     *      -- Créer une nouvelle instance du conteneur de services
     *          * En lui passant en paramètres: le chemin racine de l'application
     *            et le conteneur.
     *      -- Créer une nouvelle instance du noyau (Kernel)
     *      -- Le FontController demande au noyau de traiter la requête
     *         et de lui retourner la réponse correspondante
     * -------------------------------------------------------------------------
    */


    // Chargement de l'autoloader
    require __DIR__ . "/../vendor/autoload.php";


    // Chargement du conteneur de services
    $container = require __DIR__ . "/../src/Zion/ServicesContainer/container.php";


    // Création d'une nouvelle instance du noyau (Kernel)
    $app = new Kernel(dirname(__DIR__), $container);


    // Le FontController demande au noyau de traiter la requête
    // et de lui retourner la réponse correspondante
    $app->handle($container->get(Request::class));



    
