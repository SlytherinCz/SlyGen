<?php


namespace SlytherinCz\SlyGen\Models;


trait CollectionTrait
{
    private $collection = [];


    public function jsonSerialize()
    {
        return $this->collection;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }
}