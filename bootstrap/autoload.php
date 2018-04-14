<?php

use function DI\get;
use function DI\object;
use Otus\Controllers\PopularFilmsByAgeRangeController;
use Otus\Core\ControllerFactory;
use Otus\Core\RequestBuilder;
use Otus\Interfaces\ControllerFactoryInterface;
use Otus\Interfaces\ControllerInterface;
use Otus\Interfaces\FilmRepositoryInterface;
use Otus\Interfaces\RequestBuilderInterface;
use Otus\Repositories\FilmRepository;
use Otus\Services\FilmsByAgeService;

$root = dirname(__DIR__);

require "{$root}/vendor/autoload.php";

$builder = new \DI\ContainerBuilder();

$builder->addDefinitions([
    // routes
    'app.routes' => [
        '/get-films-by-age-range' => get(PopularFilmsByAgeRangeController::class)
    ],

    // request builder
    RequestBuilderInterface::class => object(RequestBuilder::class),

    // controller factory
    ControllerFactoryInterface::class => object(ControllerFactory::class),
    ControllerFactory::class => object()->constructor(get('app.routes')),
    //ControllerInterface::class => object(ControllerInterface::class),

    // controllers
    PopularFilmsByAgeRangeController::class => object()->constructor(get(FilmsByAgeService::class)),

    // services
    FilmsByAgeService::class => object()->constructor(get(FilmRepositoryInterface::class)),

    // repositories
    FilmRepositoryInterface::class => object(FilmRepository::class),
]);

$container = $builder->build();