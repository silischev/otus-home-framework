<?php

namespace Otus\Core;

use Otus\Exceptions\Http\NotFoundHttpException;
use Otus\Interfaces\ControllerFactoryInterface;
use Otus\Interfaces\ControllerInterface;
use Otus\Interfaces\RequestInterface;

class ControllerFactory implements ControllerFactoryInterface
{
    /**
     * @var array
     */
    private $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * {@inheritdoc}
     */
    public function getController(RequestInterface $request): ControllerInterface
    {
        $uri = current(explode('?', $request->getUri()));

        /**
         * @var ControllerInterface $route
         */
        $controller = !empty($this->routes[$uri]) ? $this->routes[$uri] : null;

        if (empty($controller)) {
            throw new NotFoundHttpException('Controller not found');
        }

        return $controller;
    }
}