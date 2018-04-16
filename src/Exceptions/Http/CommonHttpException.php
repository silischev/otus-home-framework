<?php

namespace Otus\Exceptions\Http;


class CommonHttpException extends \Exception
{
    /**
     * @var string
     */
    protected $header;

    /**
     * @param string $header
     */
    public function setHeader(string $header)
    {
        $this->header = $header;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }
}