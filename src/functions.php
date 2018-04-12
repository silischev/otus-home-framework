<?php

function pr($data, $die = false)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if ($die) {
        die();
    }
}

function vr($data, $die = false)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';

    if ($die) {
        die();
    }
}