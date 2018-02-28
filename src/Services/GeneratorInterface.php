<?php

namespace SlytherinCz\SlyGen\Services;

use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Schema;

/**
 * Interface GeneratorInterface
 * @package SlytherinCz\SlyGen\Services
 */
interface GeneratorInterface
{
    public function generate(Schema $schema) : FileBlueprint;
}