<?php

namespace Otus\Validators\FilmsSearchParameters\Interfaces;

use Otus\Interfaces\RequestInterface;

interface FilmSearchParametersValidatorInterface
{
    public function validate(RequestInterface $request);
}