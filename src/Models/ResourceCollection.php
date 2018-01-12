<?php

namespace SlytherinCz\SlyGen\Models;

use IteratorAggregate;
use SlytherinCz\SlyGen\Exceptions\ResourceNotFoundException;
use Traversable;

class ResourceCollection implements \JsonSerializable, IteratorAggregate
{
    use CollectionTrait;

    /**
     * @param Resource $resource
     */
    public function add(Resource $resource)
    {
        $this->collection[] = $resource;
    }

    /**
     * @param string $name
     * @return Resource
     * @throws ResourceNotFoundException
     */
    public function getResource(string $name) : Resource
    {
        foreach ($this->collection as $resource)
        {
            if($resource->getName() === $name)
            {
                return $resource;
            }
        }
        throw new ResourceNotFoundException();
    }
}