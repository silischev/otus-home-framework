<?php

namespace Otus\Exceptions\Http;

use Throwable;

class NotFoundHttpException extends CommonHttpException
{
    /**
     * NotFoundHttpException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setHeader('HTTP/1.1 404 Not Found');
    }

}