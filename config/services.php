<?php

use Symfony\Component\HttpFoundation\Request;

    return [
        Request::class => Request::createFromGlobals()
    ];