<?php

namespace Otus\Services;

use Otus\Interfaces\FilmInterface;
use Otus\Interfaces\FilmRepositoryInterface;

class FilmsByGenreService
{
    /**
     * @var FilmRepositoryInterface
     */
    private $filmRepository;

    /**
     * FilmsByAgeService constructor.
     *
     * @param FilmRepositoryInterface $filmRepository
     */
    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * @param array $genre
     *
     * @return FilmInterface[]
     */
    public function getByGenre(array $genre): array
    {
        return $this->filmRepository->getPopularFilmsByGenre($genre);
    }

}