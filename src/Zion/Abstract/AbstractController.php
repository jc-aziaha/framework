<?php
namespace App\Zion\Abstract;

use App\Kernel;
use Twig\Environment;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

    abstract class AbstractController
    {
        /**
         * Cette propriété représente le conteneur de services
         *
         * @var ContainerInterface
         */
        private ContainerInterface $container;

        
        public function __construct()
        {
            $this->container = Kernel::getKernel()->getContainer();
        }        


        /**
         * Cette méthode retourne le contenu du fichier $view_path.
         * 
         * Ce contenu est sous forme de chaine de caractères.
         *
         * @param string $view_path
         * @param array $parameters
         * 
         * @return string
         */
        private function renderView(string $view_path, array $parameters = []) : string
        {
            if ( ! $this->container->has(Environment::class) )
            {
                throw new \Exception("Twig bundle is not available."); 
            }

            $twig = $this->container->get(Environment::class);

            $content = $twig->render($view_path, $parameters);

            return $content;
        }


        /**
         * Grâce à la méthode renderView(), cette méthode récupère le contenu du fichier $view_path 
         * qui représente la vue.
         * Elle se sert de ce contenu pour générer la réponse à retourner à la méthode du contrôleur qui l'appelle.
         *
         * @param string $view_path
         * @param array $parameters
         * 
         * @return Response
         */
        public function render(string $view_path, array $parameters = []) : Response
        {
            $content = $this->renderView($view_path, $parameters);

            $response = new Response(
                $content,
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );

            return $response;
        }
    }