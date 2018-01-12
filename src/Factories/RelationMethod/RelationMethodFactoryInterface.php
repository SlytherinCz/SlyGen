<?php


namespace SlytherinCz\SlyGen\Factories\RelationMethod;


use Nette\PhpGenerator\ClassType;
use SlytherinCz\SlyGen\Models\Relation;
use SlytherinCz\SlyGen\Models\Schema;
use SlytherinCz\SlyGen\Models\Resource;

interface RelationMethodFactoryInterface
{
    public function create(ClassType $class,Relation $relation,Resource $reference, Schema $schema);
    public function supports(string $relationType) : bool;
}