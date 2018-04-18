<?php

namespace Otus\Validators\FilmsSearchParameters;

use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Interfaces\RequestInterface;
use Otus\Validators\FilmsSearchParameters\Interfaces\FilmSearchParametersValidatorInterface;

class ProfessionParametersValidator implements FilmSearchParametersValidatorInterface
{
    /**
     * @param RequestInterface $request
     *
     * @throws BadRequestHttpException
     */
    public function validate(RequestInterface $request)
    {
        $profession = !empty($request->getParam('profession')) ? $request->getParam('profession') : null;

        if (empty($profession)) {
            throw new BadRequestHttpException('Parameter "profession" must be defined');
        }
    }
}