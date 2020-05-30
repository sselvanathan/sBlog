<?php

    declare(strict_types=1);

    namespace Database\Config;

    use Doctrine\ORM\EntityManager as DoctrineEntityManager;
    use Doctrine\ORM\ORMException;
    use Doctrine\ORM\Tools\Setup;

    class EntityManagerConfig
    {
        protected const ENTITIES_PATH = __DIR__ . '/../Entities';
        protected $proxyDir = null;
        protected $cache = null;
        protected $useSimpleAnnotationReader = false;

        protected function isDevMode()
        {
            return true; //ToDo check via DB
        }

        public function createEntityManager()
        {
            $database = new DatabaseConfig();
            $dbParams = $database->getDbParams();
            $config = Setup::createAnnotationMetadataConfiguration(
                [self::ENTITIES_PATH],
                $this->isDevMode(),
                $this->proxyDir,
                $this->cache,
                $this->useSimpleAnnotationReader
            );

            try {
                return $entityManager = DoctrineEntityManager::create($dbParams, $config);
            } catch (ORMException $e) {
                return $e;
            }
        }
    }

