<?php

namespace Otus\Controllers;

use Otus\Core\Response;
use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Helpers\FilmsUserViewHelper;
use Otus\Helpers\HttpRequestHelper;
use Otus\Interfaces\ControllerInterface;
use Otus\Interfaces\RequestInterface;
use Otus\Interfaces\ResponseInterface;
use Otus\Services\FilmsByProfessionService;
use Otus\Validators\FilmsSearchParameters\ProfessionParametersValidator;

class PopularFilmsByProfessionController implements ControllerInterface
{
    /**
     * @var FilmsByProfessionService
     */
    private $filmsByProfessionService;

    /**
     * PopularFilmsByProfessionController constructor.
     *
     * @param FilmsByProfessionService $filmsByProfessionService
     */
    public function __construct(FilmsByProfessionService $filmsByProfessionService)
    {
        $this->filmsByProfessionService = $filmsByProfessionService;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $requestValidator = new ProfessionParametersValidator();
        $requestValidator->validate($request);

        $profession = $request->getParam('profession');

        $professionsList = HttpRequestHelper::getParameterListAsArray($profession);
        $films = $this->filmsByProfessionService->getByProfession($professionsList);

        return new Response(FilmsUserViewHelper::getFilmsAsList($films));
    }
}