<?php

namespace Otus\Controllers;

use Otus\Core\Response;
use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Helpers\FilmsUserViewHelper;
use Otus\Interfaces\ControllerInterface;
use Otus\Interfaces\RequestInterface;
use Otus\Interfaces\ResponseInterface;
use Otus\Services\FilmsByAgeService;

class PopularFilmsByAgeRangeController implements ControllerInterface
{
    /**
     * @var FilmsByAgeService
     */
    private $filmsByAgeService;

    /**
     * PopularFilmsByAgeRangeController constructor.
     *
     * @param FilmsByAgeService $filmsByAgeService
     */
    public function __construct(FilmsByAgeService $filmsByAgeService)
    {
        $this->filmsByAgeService = $filmsByAgeService;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $fromAge = !empty($request->getParam('from')) ? $request->getParam('from') : null;
        $toAge = !empty($request->getParam('to')) ? $request->getParam('to') : null;

        if (empty($fromAge) || empty($toAge)) {
            throw new BadRequestHttpException('Parameters "from" and "to" must be defined');
        }

        $films = $this->filmsByAgeService->getByRange($fromAge, $toAge);

        return new Response(FilmsUserViewHelper::getFilmsAsList($films));
    }
}