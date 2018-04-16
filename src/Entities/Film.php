<?php

namespace Otus\Entities;

use Otus\Interfaces\FilmInterface;

class Film implements FilmInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $releaseDate;

    /**
     * Film constructor.
     *
     * @param int $id
     * @param string $title
     * @param string $releaseDate
     */
    public function __construct(int $id, string $title, string $releaseDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
    }

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @inheritDoc
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }
}