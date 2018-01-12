<?php

namespace SlytherinCz\SlyGen\Helpers;

use SlytherinCz\SlyGen\Models\Schema;

class ResourceModelNameHelper
{
    public static function getModelName(string $resourceName): string
    {
        return ucfirst($resourceName) . 'Model';
    }

    public static function getFullyQualifiedModelName(Schema $schema, string $resourceName): string
    {
        return $schema->getName().'\\Models\\'.self::getModelName($resourceName);
    }
}