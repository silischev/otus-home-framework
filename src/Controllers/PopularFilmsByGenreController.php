<?php

namespace Otus\Controllers;

use Otus\Core\Response;
use Otus\Exceptions\Http\BadRequestHttpException;
use Otus\Helpers\FilmsUserViewHelper;
use Otus\Helpers\HttpRequestHelper;
use Otus\Interfaces\ControllerInterface;
use Otus\Interfaces\RequestInterface;
use Otus\Interfaces\ResponseInterface;
use Otus\Services\FilmsByGenreService;

class PopularFilmsByGenreController implements ControllerInterface
{
    /**
     * @var FilmsByGenreService
     */
    private $filmsByGenreService;

    /**
     * PopularFilmsByGenreController constructor.
     *
     * @param FilmsByGenreService $filmsByGenreService
     */
    public function __construct(FilmsByGenreService $filmsByGenreService)
    {
        $this->filmsByGenreService = $filmsByGenreService;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $genre = !empty($request->getParam('genre')) ? $request->getParam('genre') : null;

        if (empty($genre)) {
            throw new BadRequestHttpException('Parameter "genre" must be defined');
        }

        $genresList = HttpRequestHelper::getParameterListAsArray($genre);
        $films = $this->filmsByGenreService->getByGenre($genresList);

        return new Response(FilmsUserViewHelper::getFilmsAsList($films));
    }
}