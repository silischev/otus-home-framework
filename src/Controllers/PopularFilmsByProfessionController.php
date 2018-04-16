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
        $profession = !empty($request->getParam('profession')) ? $request->getParam('profession') : null;

        if (empty($profession)) {
            throw new BadRequestHttpException('Parameter "profession" must be defined');
        }

        $professionsList = HttpRequestHelper::getParameterListAsArray($profession);
        $films = $this->filmsByProfessionService->getByProfession($professionsList);

        return new Response(FilmsUserViewHelper::getFilmsAsList($films));
    }
}