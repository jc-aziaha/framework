<?php
declare(strict_types=1);

namespace App\Controller\Error;

use Symfony\Component\HttpFoundation\Response;

    class ErrorController
    {

        public function notFound() : Response
        {
            $response = new Response(
                '404 NOT FOUND',
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'text/html']
            );

            return $response;
        }
    }