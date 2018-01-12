<?php


namespace SlytherinCz\SlyGen\Services;


use Nette\PhpGenerator\PhpNamespace;
use SlytherinCz\SlyGen\Models\Schema;
use SlytherinCz\SlyGen\Models\Resource;

interface ClassGeneratorInterface
{
    function createNamespace(Schema $schema,Resource $resource) : PhpNamespace;
}