<?php

include_once(__DIR__.'/../vendor/autoload.php');
include_once(__DIR__.'/../src/bootstrap.php');

use Symfony\Component\Console\Application;

$application = new Application();
$application->add($container->get('console.generator'));

$application->run();