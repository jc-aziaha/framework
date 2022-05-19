<?php

require __DIR__ . "/../vendor/autoload.php";

require __DIR__ . "/../src/Zion/ServicesContainer/container.php";

use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;

$config = new PhpFile(__DIR__ . "/../migrations.php"); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

$entityManager = $container->get(EntityManager::class);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));