<?php

declare(strict_types=1);

namespace Sony\Sony\Factory;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

class EntityFactory
{
    public static function getEntityManager(): EntityManagerInterface
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: array(__DIR__."/src"),
            isDevMode: true,
        );

        $connectionParams = [
            'dbname' => '',
            'user' => 'root',
            'password' => 'secret',
            'host' => 'localhost:3306',
            'driver' => 'pdo_mysql',
        ];

        $connection = DriverManager::getConnection($connectionParams);

        return new EntityManager($connection, $config);
    }
}