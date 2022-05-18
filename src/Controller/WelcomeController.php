<?php
declare(strict_types=1);

namespace App\Controller;

    class WelcomeController
    {
        #[Route('/', name: 'index', methods: ['GET'])]
        public function index()
        {
            
        }


        #[Route('/test', name: 'test', methods: ['GET'])]
        public function test()
        {
            
        }
    }