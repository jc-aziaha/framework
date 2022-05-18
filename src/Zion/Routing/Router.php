<?php
namespace App\Zion\Routing;

use App\Zion\Contract\RouterInterface;

    class Router implements RouterInterface
    {
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
         * Cette méthode stocke les routes dont l'application attend la réception dans une armoire à routes ($routes).
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
                    $reflectionAttributes = $reflectionMethod->getAttributes();

                    dd($reflectionAttributes);
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
            
        }
    }