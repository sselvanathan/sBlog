<?php

    use Database\Config\EntityManagerConfig;
    use Doctrine\ORM\Tools\Console\ConsoleRunner;

    require 'vendor/autoload.php';

    $entityManager = new EntityManagerConfig();

    return ConsoleRunner::createHelperSet($entityManager->createEntityManager());
