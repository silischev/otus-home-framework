<?php
/**
 * Created by PhpStorm.
 * User: Julia
 * Date: 16.04.2018
 * Time: 17:15
 */

namespace Otus\Helpers;


class HttpRequestHelper
{
    /**
     * @param string $list
     *
     * @return array
     */
    public static function getParameterListAsArray(string $list): array
    {
        return explode(',', $list);
    }
}