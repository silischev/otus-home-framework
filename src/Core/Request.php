<?php

namespace Otus\Core;

use Otus\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    const METHOD_TYPE_GET = 'GET';
    const METHOD_TYPE_POST = 'POST';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var array
     */
    private $params;

    public function __construct(string $type, string $uri, array $params = [])
    {
        $this->type = $type;
        $this->uri = $uri;
        $this->params = $params;
    }

    public function getParam(string $key, string $default = null): ?string
    {
        return !empty($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

}