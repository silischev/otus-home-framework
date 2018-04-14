<?php

namespace Otus\Core;

use Otus\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var string
     */
    private $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function getResponse(): string
    {
        return $this->data;
    }

}