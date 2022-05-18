<?php
declare(strict_types=1);

namespace App\Controller;

use App\Zion\Attribute\Route;

    class WelcomeController
    {
        #[Route('/', name: 'index', methods: ['GET'])]
        public function index()
        {
            
        }


        #[Route('/test/{id}', name: 'test', methods: ['GET'])]
        public function test()
        {
            
        }
    }