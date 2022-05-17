<?php
namespace App;

use Psr\Container\ContainerInterface;
use App\Zion\Contract\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

    /**
     * ----------------------------------------------------------------------
     * Le kernel
     * 
     * @author Jean-Claude AZIAHA <aziaha.formations@gmail.com>
     * 
     * @version 1.0.0
     * 
     * Cet fichier représente le noyau de l'application
     * 
     * Ses tâches : 
     * 
     *      -- Traiter la requête et retourner la réponse correspondante
     * ----------------------------------------------------------------------
    */

    class Kernel implements HttpKernelInterface
    {

        /**
         * Cette propriété représente le chemin racine de l'application
         *
         * @var string
         */
        private string $basePath;


        /**
         * Cette propriété représente le conteneur de services
         *
         * @var ContainerInterface
         */
        private ContainerInterface $container;



        public function __construct(string $base_path, ContainerInterface $container)
        {
            $this->basePath  = $base_path;
            $this->container = $container;
        }



        /**
         * Cette méthode permet de traiter la requête
         * et de retourner une réponse grâce au router
         *
         * @param Request $request
         * 
         * @return Response
         */
        public function handle(Request $request) : Response
        {
            // Pause 
        }
    }