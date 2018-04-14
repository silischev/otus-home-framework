<?php

require_once(__DIR__ . '/bootstrap/autoload.php');
require_once(__DIR__ . '/src/functions.php');

try {
    $requestBuilder = $container->get(Otus\Interfaces\RequestBuilderInterface::class);

    $request = $requestBuilder->getRequest($_GET, $_POST);

    $controllerFactory = $container->get(Otus\Interfaces\ControllerFactoryInterface::class);

    $controller = $controllerFactory->getController($request);

    $response = $controller->execute($request);

    vr($response, 1);

    echo $response->getResponse();
} catch (Throwable $e) {
    echo $e->getMessage();
}
