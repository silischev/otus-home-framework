<?php

namespace Otus\Controllers;

use Otus\Core\Response;
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
        pr($this->filmsByAgeService->getByRange(10, 15), 1);

        $response = new Response('');

        return $response;
    }
}