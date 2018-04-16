<?php

namespace Otus\Helpers;

use Otus\Interfaces\FilmInterface;

class FilmsUserViewHelper
{
    /**
     * @param FilmInterface[] $films
     *
     * @return string
     */
    public static function getFilmsAsList(array $films)
    {
        $content = '';

        foreach ($films as $film) {
            $content .= $film->getReleaseDate() . ' - ' . $film->getTitle() . '<br>';
        }

        return $content;
    }

}