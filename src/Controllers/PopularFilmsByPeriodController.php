<?php

namespace Otus\Controllers;

use Otus\Core\Response;
use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Helpers\FilmsUserViewHelper;
use Otus\Interfaces\ControllerInterface;
use Otus\Interfaces\RequestInterface;
use Otus\Interfaces\ResponseInterface;
use Otus\Services\FilmsByPeriodService;
use Otus\Validators\FilmsSearchParameters\PeriodParametersValidator;

class PopularFilmsByPeriodController implements ControllerInterface
{
    /**
     * @var FilmsByPeriodService
     */
    private $filmsByPeriodService;

    /**
     * PopularFilmsByPeriodController constructor.
     *
     * @param FilmsByPeriodService $filmsByPeriodService
     */
    public function __construct(FilmsByPeriodService $filmsByPeriodService)
    {
        $this->filmsByPeriodService = $filmsByPeriodService;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $requestValidator = new PeriodParametersValidator();
        $requestValidator->validate($request);

        $fromYear = $request->getParam('from');
        $toYear = $request->getParam('to');

        $films = $this->filmsByPeriodService->getByPeriod($fromYear, $toYear);

        return new Response(FilmsUserViewHelper::getFilmsAsList($films));
    }
}