<?php

namespace SlytherinCz\SlyGen\Helpers;

use SlytherinCz\SlyGen\Models\Schema;

class ResourceModelNameHelper
{
    public static function getModelName(string $resourceName): string
    {
        return ucfirst($resourceName);
    }

    public static function getFullyQualifiedModelName(Schema $schema, string $resourceName): string
    {
        return $schema->getName().'\\'.NamespaceDictionary::MODEL.'\\'.self::getModelName($resourceName);
    }
}