<?php

declare(strict_types=1);

namespace Database\Config;

use Doctrine\DBAL\Driver\Exception;
use Doctrine\ORM\EntityManager as DoctrineEntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

class EntityManagerConfig
{
    protected const ENTITIES_PATH = __DIR__ . '/../Entities';
    protected bool $useSimpleAnnotationReader = false;

    protected function isDevMode(): bool
    {
        return true; //ToDo check via DB
    }

    public function createEntityManager(): DoctrineEntityManager|Exception|ORMException
    {
        $database = new DatabaseConfig();
        $dbParams = $database->getDbParams();
        $config = Setup::createAnnotationMetadataConfiguration(
            [self::ENTITIES_PATH],
            $this->isDevMode(),
            null,
            null,
            $this->useSimpleAnnotationReader
        );

        try {
            return $entityManager = DoctrineEntityManager::create($dbParams, $config);
        } catch (ORMException $e) {
            return $e;
        }
    }
}
