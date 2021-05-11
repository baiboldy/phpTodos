<?php
namespace config;

use Doctrine\ORM\EntityManager;

class Config
{
    private static $entityManager;

    public static function setEntityManager(EntityManager $manager) {
        self::$entityManager = $manager;
    }

    public static function getEntityManager() : EntityManager {
        return self::$entityManager;
    }
}