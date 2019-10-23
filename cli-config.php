<?php

require_once 'app/core/db.php';

$db = new Db();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($db->entityManager);