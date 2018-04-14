<?php

namespace Otus\Services;

use Otus\Interfaces\FilmRepositoryInterface;

class FilmsByAgeService
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

    public function getByRange(int $fromAge, int $toAge)
    {
        $films = $this->filmRepository->getPopularFilmsByAgeRange($fromAge, $toAge);

        return $films;
    }

}