<?php

namespace Otus\Services;

use Otus\Interfaces\FilmInterface;
use Otus\Interfaces\FilmRepositoryInterface;

class FilmsByProfessionService
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
     * @param array $profession
     *
     * @return FilmInterface[]
     */
    public function getByProfession(array $profession): array
    {
        return $this->filmRepository->getPopularFilmsByProfession($profession);
    }

}