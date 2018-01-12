<?php

namespace SlytherinCz\SlyGen\Helpers;

class ResourceControllerNameHelper
{
    public static function getControllerName(string $resourceName):string
    {
        return ucfirst($resourceName).'Controller';
    }
}