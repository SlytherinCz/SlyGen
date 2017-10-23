<?php

namespace SlytherinCz\SlyGen\Models;

class ResourceCollection implements \JsonSerializable
{
    /**
     * @var array
     */
    private $collection = [];

    public function add(Resource $resource)
    {
        $this->collection[] = $resource;
    }

    public function jsonSerialize()
    {
        return $this->collection;
    }
}