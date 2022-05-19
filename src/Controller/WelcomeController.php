<?php
declare(strict_types=1);

namespace App\Controller;

use App\Zion\Attribute\Route;
use App\Zion\Abstract\AbstractController;
use Symfony\Component\HttpFoundation\Response;


    class WelcomeController extends AbstractController
    {
        #[Route('/', name: 'index', methods: ['GET'])]
        public function index() : Response
        {
            return $this->render("index.html.twig");
        }


        #[Route('/test/{id}', name: 'test', methods: ['GET'])]
        public function test($tab)
        {
            // dd($tab);
            $response = new Response(
                'test',
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );

            return $response;
        }
    }