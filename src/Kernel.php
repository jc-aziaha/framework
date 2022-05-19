<?php
namespace App;

use App\Kernel;
use App\Zion\Routing\Router;
use Psr\Container\ContainerInterface;
use App\Controller\Error\ErrorController;
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


        /**
         * Cette propriété représente le routeur
         *
         * @var Router
         */
        private Router $router;


        /**
         * Cette propriété représente le noyau dans lui-même
         *
         * @var Kernel
         */
        private static Kernel $kernel;



        public function __construct(string $base_path, ContainerInterface $container)
        {
            self::$kernel    = $this;
            $this->basePath  = $base_path;
            $this->container = $container;
            $this->router    = $this->container->get(Router::class);

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

            $controllers = $this->container->get('controllers');

            $this->router->collectControllers($controllers);

            $router_response = $this->router->resolve();

            $controller_response = $this->getControllerResponse($router_response);
            return $controller_response;
        }

        private function getControllerResponse($router_response)
        {
            if ( !is_array($router_response) && (null == $router_response) ) 
            {
                return $this->container->call([ErrorController::class, "notFound"]);
            }

            $controller = $router_response['route']['class'];
            $method     = $router_response['route']['method'];

            // dd($router_response);

            if ( isset($router_response['parameters']) && !empty($router_response['parameters']) ) 
            {
                $parameters = $router_response['parameters'];
                return $this->container->call([$controller, $method], [$parameters]);
            }

            return $this->container->call([$controller, $method]);
        }


        public static function getKernel()
        {
            return self::$kernel;
        }

        public function getContainer()
        {
            return $this->container;
        }


    }