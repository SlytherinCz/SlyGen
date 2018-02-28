<?php


namespace SlytherinCz\SlyGen\Services;


use Nette\PhpGenerator\PhpNamespace;
use SlytherinCz\SlyGen\Models\Resource;
use SlytherinCz\SlyGen\Models\Schema;

interface ClassGeneratorInterface
{
    function createNamespace(Schema $schema, Resource $resource): PhpNamespace;
}