<?php

use Otus\Core\DbConnection;
use Otus\Exceptions\Http\CommonHttpException;
use Otus\Interfaces\ControllerFactoryInterface;
use Otus\Interfaces\RequestBuilderInterface;

require_once(__DIR__ . '/bootstrap/autoload.php');
require_once(__DIR__ . '/src/functions.php');

try {
    $db = $container->get(DbConnection::class);

    $requestBuilder = $container->get(RequestBuilderInterface::class);

    $request = $requestBuilder->getRequest($_GET, $_POST);

    $controllerFactory = $container->get(ControllerFactoryInterface::class);

    $controller = $controllerFactory->getController($request);

    $response = $controller->execute($request);

    echo $response->getResponse();
} catch (CommonHttpException $e) {
    header($e->getHeader());
    echo $e->getMessage();
} catch (Throwable $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo $e->getMessage();
}
