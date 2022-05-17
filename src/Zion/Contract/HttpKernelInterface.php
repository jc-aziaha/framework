<?php
namespace App\Zion\Contract;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

    interface HttpKernelInterface
    {

        /**
         * Cette méthode permet de traiter la requête
         * et de retourner une réponse grâce au router
         *
         * @param Request $request
         * 
         * @return Response
         */
        public function handle(Request $request) : Response;
    }