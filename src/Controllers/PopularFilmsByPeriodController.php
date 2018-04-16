<?php

namespace Otus\Controllers;

use Otus\Core\Response;
use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Helpers\FilmsUserViewHelper;
use Otus\Interfaces\ControllerInterface;
use Otus\Interfaces\RequestInterface;
use Otus\Interfaces\ResponseInterface;
use Otus\Services\FilmsByPeriodService;

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
        $fromYear = !empty($request->getParam('from')) ? $request->getParam('from') : null;
        $toYear = !empty($request->getParam('to')) ? $request->getParam('to') : null;

        if (empty($fromYear) || empty($toYear)) {
            throw new BadRequestHttpException('Parameters "from" and "to" must be defined');
        }

        $films = $this->filmsByPeriodService->getByPeriod($fromYear, $toYear);

        return new Response(FilmsUserViewHelper::getFilmsAsList($films));
    }
}