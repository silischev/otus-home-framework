<?php

namespace Otus\Validators\FilmsSearchParameters;

use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Interfaces\RequestInterface;
use Otus\Validators\FilmsSearchParameters\Interfaces\FilmSearchParametersValidatorInterface;

class GenreParametersValidator implements FilmSearchParametersValidatorInterface
{
    /**
     * @param RequestInterface $request
     *
     * @throws BadRequestHttpException
     */
    public function validate(RequestInterface $request)
    {
        $genre = !empty($request->getParam('genre')) ? $request->getParam('genre') : null;

        if (empty($genre)) {
            throw new BadRequestHttpException('Parameter "genre" must be defined');
        }
    }
}