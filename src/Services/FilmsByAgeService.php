<?php

namespace Otus\Services;

use Otus\Interfaces\FilmInterface;
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

    /**
     * @param int $fromAge
     * @param int $toAge
     *
     * @return FilmInterface[]
     */
    public function getByRange(int $fromAge, int $toAge): array
    {
        return $this->filmRepository->getPopularFilmsByAgeRange($fromAge, $toAge);
    }

}