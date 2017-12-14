<?php

use Application\Controller;
use Application\Controller\IndexController;
use Application\Controller\LecturerController;
use Application\Factory\ParseUriHelperFactory;
use Application\Factory\RouterFactory;
use Application\Repository\LecturerRepository;
use Application\Router\ParseUriHelper;
use Application\Router\Router;
use Psr\Container\ContainerInterface;

return [
    'factories' => [
        ParseUriHelper::class => ParseUriHelperFactory::class,
        Router::class => RouterFactory::class,
        DateTimeInterface::class => function(ContainerInterface $container) {
            return new DateTimeImmutable();
        },
        LecturerController::class => function(ContainerInterface $container) {
            return new Controller\LecturerController();
        },
        LecturerRepository::class => function (ContainerInterface $container) {
            return new Application\Repository\LecturerRepository($container->get(PDO::class));
        },
        IndexController::class => function(ContainerInterface $container) {
          $databaseConnection = $container->get(LecturerRepository::class);
            return new IndexController($databaseConnection);
        },
        PDO::class => function(ContainerInterface $container) {
            $dbConnect = new \PDO('mysql:host=database;dbname=demo','demo', 'demo');
            $dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnect;
        },
    ],
];
