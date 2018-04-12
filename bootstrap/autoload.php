<?php

$root = dirname(__DIR__);

require "{$root}/vendor/autoload.php";

$builder = new \DI\ContainerBuilder();

// TODO: addDefinitions here
//$builder->addDefinitions();

$container = $builder->build();