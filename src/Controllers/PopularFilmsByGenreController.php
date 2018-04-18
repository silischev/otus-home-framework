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
use Otus\Validators\FilmsSearchParameters\GenreParametersValidator;

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
        $requestValidator = new GenreParametersValidator();
        $requestValidator->validate($request);

        $genre = $request->getParam('genre');

        $genresList = HttpRequestHelper::getParameterListAsArray($genre);
        $films = $this->filmsByGenreService->getByGenre($genresList);

        return new Response(FilmsUserViewHelper::getFilmsAsList($films));
    }
}