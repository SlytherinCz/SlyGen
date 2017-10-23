<?php


namespace SlytherinCz\SlyGen\Services;


use SlytherinCz\SlyGen\Models\Schema;

interface GeneratorInterface
{
    public function generate(Schema $schema);
}