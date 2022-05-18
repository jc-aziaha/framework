<?php
namespace App\Zion\Attribute;

    #[\Attribute(\Attribute::TARGET_METHOD)]
    class Route
    {

        /**
         * Cette propriété représente l'uri de la route
         *
         * @var string
         */
        private string $path;

        /**
         * Cette propriété représente le nom de route
         *
         * @var string
         */
        private string $name;

        /**
         * Cette propriété représente les methodes d'envoi de la requête
         *
         * @var array
         */
        private array $methods;



        public function __construct(string $path, string $name, array $methods)
        {
            $this->path     = $path;
            $this->name     = $name;
            $this->methods  = $methods;
        }

        public function getPath()
        {
            return $this->path;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getMethods()
        {
            return $this->methods;
        }
    }