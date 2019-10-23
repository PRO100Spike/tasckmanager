<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
require_once "application/models/Task.php";

class Db {

    public $entityManager;

    function __construct() {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/../models"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        // database configuration parameters
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/db.sqlite',
        );

        // obtaining the entity manager
        $this->entityManager = EntityManager::create($conn, $config);
    }

    /**
     * @return array|object[]
     */
    public function getTask () {
        $taskRepository = $this->entityManager->getRepository('Task');
        $tasks = $taskRepository->findBy([], [], 3);

        return $tasks;
    }

}

