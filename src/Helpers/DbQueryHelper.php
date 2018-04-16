<?php

namespace Otus\Helpers;

class DbQueryHelper
{
    /**
     * @param array $list
     *
     * @return string
     */
    public static function getNoNamePlaceholdersList(array $list): string
    {
        return implode(',', array_fill(0, count($list), '?'));
    }
}