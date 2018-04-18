<?php

namespace Otus\Validators\FilmsSearchParameters;

use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Interfaces\RequestInterface;
use Otus\Validators\FilmsSearchParameters\Interfaces\FilmSearchParametersValidatorInterface;

class AgeParametersValidator implements FilmSearchParametersValidatorInterface
{
    /**
     * @param RequestInterface $request
     *
     * @throws BadRequestHttpException
     */
    public function validate(RequestInterface $request)
    {
        $fromAge = !empty($request->getParam('from')) ? $request->getParam('from') : null;
        $toAge = !empty($request->getParam('to')) ? $request->getParam('to') : null;

        if (empty($fromAge) || empty($toAge)) {
            throw new BadRequestHttpException('Parameters "from" and "to" must be defined');
        }

        if (!is_numeric($fromAge) || !is_numeric($toAge)) {
            throw new BadRequestHttpException('Parameters "from" and "to" must be an integer');
        }

        if ($fromAge > $toAge) {
            throw new BadRequestHttpException('Parameters "from" must be less than "to"');
        }
    }
}