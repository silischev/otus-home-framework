<?php

namespace Otus\Controllers;

use Otus\Core\Response;
use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Helpers\FilmsUserViewHelper;
use Otus\Interfaces\ControllerInterface;
use Otus\Interfaces\RequestInterface;
use Otus\Interfaces\ResponseInterface;
use Otus\Services\FilmsByAgeService;
use Otus\Validators\FilmsSearchParameters\AgeParametersValidator;
use Otus\Validators\FilmsSearchParameters\AgeParameterValidator;

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
        $requestValidator = new AgeParametersValidator();
        $requestValidator->validate($request);

        $fromAge = $request->getParam('from');
        $toAge = $request->getParam('to');

        $films = $this->filmsByAgeService->getByRange($fromAge, $toAge);

        return new Response(FilmsUserViewHelper::getFilmsAsList($films));
    }
}