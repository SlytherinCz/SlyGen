<?php

include_once('../vendor/autoload.php');
include_once('../src/bootstrap.php');

use Symfony\Component\Console\Application;

$application = new Application();
$application->add($container->get('console.generator'));

$application->run();