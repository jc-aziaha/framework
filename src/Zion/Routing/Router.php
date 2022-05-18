<?php
namespace App\Zion\Routing;

use App\Kernel;
use App\Zion\Attribute\Route;
use App\Zion\Contract\RouterInterface;
use Symfony\Component\HttpFoundation\Request;

    class Router implements RouterInterface
    {


        /**
         * Cette propriété représente l'armoire à routes
         *
         * @var array
         */
        private array $routes = [];


        /**
         * Cette propriété représente les paramètres de la route qui a matché
         */
        private array $parameters = [];




        /**
         * Cette méthode permet de récupérer la liste de tous les contrôleurs de l'application 
         * qui lui est fournie par le noyau (kernel).
         * 
         * Elle transmet cette liste à la méthode "addRoutes"
         *
         * @param array $controllers
         * 
         * @return void
         */
        public function collectControllers(array $controllers) : void
        {
            $this->addRoutes($controllers);
        }


        /**
         * Cette méthode stocke les routes de l'application dans une armoire à routes ($routes)
         * en prenant soin de les trier par nom.
         *
         * @param array $controllers
         * 
         * @return void
         */
        public function addRoutes(array $controllers) : void
        {
            foreach ($controllers as $controller) 
            {
                $reflectionController = new \ReflectionClass($controller);

                $reflectionMethods = $reflectionController->getMethods();

                foreach ($reflectionMethods as $reflectionMethod) 
                {
                    $reflectionAttributes = $reflectionMethod->getAttributes(Route::class);

                    foreach ($reflectionAttributes as $reflectionAttribute) 
                    {
                        $route = $reflectionAttribute->newInstance();

                        $this->routes[$route->getName()] = [
                            "class"  => $reflectionMethod->class,
                            "method" => $reflectionMethod->name,
                            "route"  => $route
                        ];
                    }
                }
            }
        }
        
        
        /**
         * Cette méthode vérifie si l'uri de l'url correspond à l'uri de la route.
         * 
         * Si tel est le cas, un tableau contenant les informations du contrôleur 
         * chargé de gérer cet événement est retourné.
         * 
         * Sinon, une valeur "null" est plutôt retournée.
         *
         * @return array|null
         */
        public function resolve() : ?array
        {
            // Récupérer l'uri de l'url
            $request = Kernel::getKernel()->getContainer()->get(Request::class);
            $uri_url = $request->server->get('REQUEST_URI');
            
            foreach ($this->routes as $route) 
            {
                $uri_route = $route['route']->getPath();

                if($this->matches($uri_url, $uri_route))
                {
                    if ( isset($this->parameters) && !empty($this->parameters) ) 
                    {
                        return [
                            "route" => $route,
                            "parameters" => $this->parameters
                        ];
                    }

                    return [
                        "route" => $route
                    ];
                }
            }

            return null;
        }

        private function matches($uri_url, $uri_route)
        {
            $pattern = preg_replace("#{[a-z]+}#", "([a-zA-Z0-9-_]+)", $uri_route);
            $pattern = "#^$pattern$#";

            if ( preg_match($pattern, $uri_url, $matches) ) 
            {
                array_shift($matches);
                $this->parameters = $matches;
                return true;
            }

            return false;
        }
    }