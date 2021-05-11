<?php

use config\Config;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require_once "vendor/autoload.php";

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
  $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$responseFactory = new \Laminas\Diactoros\ResponseFactory();

$strategy = new League\Route\Strategy\JsonStrategy($responseFactory);
$router   = (new League\Route\Router)->setStrategy($strategy);

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
$connection = array(
    "dbname" => "haudi",
    "user" => "postgres",
    "password" => "password",
    "host" => "localhost",
    "port" => "5432",
    "driver" => "pdo_pgsql"
);

$entityManager = EntityManager::create($connection, $config);
Config::setEntityManager($entityManager);
