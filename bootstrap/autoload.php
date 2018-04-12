<?php

use function DI\object;
use Otus\Core\RequestBuilder;
use Otus\Interfaces\RequestBuilderInterface;

$root = dirname(__DIR__);

require "{$root}/vendor/autoload.php";

$builder = new \DI\ContainerBuilder();

$builder->addDefinitions([
    RequestBuilderInterface::class => object(RequestBuilder::class),

    /*'RequestBuilderInterface' => function() {
        return new RequestBuilder();
    }*/
]);

$container = $builder->build();