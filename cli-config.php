<?php

require_once 'application/core/Db.php';

$db = new Db();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($db->entityManager);