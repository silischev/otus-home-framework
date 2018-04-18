<?php

namespace Otus\Validators\FilmsSearchParameters;

use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Interfaces\RequestInterface;
use Otus\Validators\FilmsSearchParameters\Interfaces\FilmSearchParametersValidatorInterface;

class PeriodParametersValidator implements FilmSearchParametersValidatorInterface
{
    /**
     * @param RequestInterface $request
     *
     * @throws BadRequestHttpException
     */
    public function validate(RequestInterface $request)
    {
        $fromYear = !empty($request->getParam('from')) ? $request->getParam('from') : null;
        $toYear = !empty($request->getParam('to')) ? $request->getParam('to') : null;

        if (empty($fromYear) || empty($toYear)) {
            throw new BadRequestHttpException('Parameters "from" and "to" must be defined');
        }

        if (!is_numeric($fromYear) || !is_numeric($toYear)) {
            throw new BadRequestHttpException('Parameters "from" and "to" must be an integer');
        }
    }
}