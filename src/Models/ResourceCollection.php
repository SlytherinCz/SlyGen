<?php

namespace SlytherinCz\SlyGen\Models;

use IteratorAggregate;
use Traversable;

class ResourceCollection implements \JsonSerializable, IteratorAggregate
{
    use CollectionTrait;

    public function add(Resource $resource)
    {
        $this->collection[] = $resource;
    }
}