<?php

use function DI\get;
use function DI\object;
use Dotenv\Dotenv;
use Otus\Controllers\PopularFilmsByAgeRangeController;
use Otus\Controllers\PopularFilmsByGenreController;
use Otus\Controllers\PopularFilmsByPeriodController;
use Otus\Controllers\PopularFilmsByProfessionController;
use Otus\Core\ControllerFactory;
use Otus\Core\DbConnection;
use Otus\Core\RequestBuilder;
use Otus\Interfaces\ControllerFactoryInterface;
use Otus\Interfaces\ControllerInterface;
use Otus\Interfaces\FilmRepositoryInterface;
use Otus\Interfaces\RequestBuilderInterface;
use Otus\Repositories\FilmRepository;
use Otus\Services\FilmsByAgeService;

$root = dirname(__DIR__);

require "{$root}/vendor/autoload.php";

$dotEnv = new Dotenv(__DIR__ . '/..');
$dotEnv->load();
$dotEnv->required('DB_DSN');
$dotEnv->required('DB_USERNAME');
$dotEnv->required('DB_PASSWORD');

$builder = new \DI\ContainerBuilder();

$builder->addDefinitions(array(
    // routes
    'app.routes' => array(
        '/get-films-by-age-range' => get(PopularFilmsByAgeRangeController::class),
        '/get-films-by-genre' => get(PopularFilmsByGenreController::class),
        '/get-films-by-profession' => get(PopularFilmsByProfessionController::class),
        '/get-films-by-period' => get(PopularFilmsByPeriodController::class),
    ),

    // request builder
    RequestBuilderInterface::class => object(RequestBuilder::class),

    // controller factory
    ControllerFactoryInterface::class => object(ControllerFactory::class),
    ControllerFactory::class => object()->constructor(get('app.routes')),

    // controllers
    PopularFilmsByAgeRangeController::class => object()->constructor(get(FilmsByAgeService::class)),

    // services
    FilmsByAgeService::class => object()->constructor(get(FilmRepositoryInterface::class)),

    // repositories
    FilmRepositoryInterface::class => object(FilmRepository::class),

    // db connection
    DbConnection::class => object()->constructor(
        getenv('DB_DSN'),
        getenv('DB_USERNAME'),
        getenv('DB_PASSWORD')
    )
));

$container = $builder->build();