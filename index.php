<?php

require_once(__DIR__ . '/bootstrap/autoload.php');
require_once(__DIR__ . '/src/functions.php');

pr($container, 1);

$requestBuilder = $container->get(Otus\Interfaces\RequestBuilderInterface::class);
pr($requestBuilder);

/*$request = $requestBuilder->getRequest($_GET, $_POST);

$controllerFactory = $container->get(Otus\Interfaces\ControllerFactoryInterface::class);

$controller = $controllerFactory->getController($request);

$response = $controller->execute($request);

echo $response->getResponse();*/
