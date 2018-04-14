<?php

namespace Otus\Core;

use Otus\Interfaces\RequestBuilderInterface;
use Otus\Interfaces\RequestInterface;

class RequestBuilder implements RequestBuilderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRequest(array $get, array $post): RequestInterface
    {
        $requestData = [];
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestType = $_SERVER['REQUEST_METHOD'];

        if ($requestType === Request::METHOD_TYPE_GET) {
            $requestData = $get;
        } elseif ($requestType === Request::METHOD_TYPE_POST) {
            $requestData = $post;
        }

        return new Request($requestType, $requestUri, $requestData);
    }
}