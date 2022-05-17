<?php

    $builder = new DI\ContainerBuilder();
    $builder->addDefinitions(__DIR__ . "/../../../config/services.php");
    $container = $builder->build();

    return $container;