<?php

    use Database\Config\EntityManager;
    use Doctrine\ORM\Tools\Console\ConsoleRunner;

    require 'vendor/autoload.php';
    require 'autoload.php';

    $entityManager = new EntityManager();

    return ConsoleRunner::createHelperSet($entityManager->createEntityManager());
