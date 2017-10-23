<?php

namespace SlytherinCz\SlyGen\Models;

use SlytherinCz\SlyGen\Models\Indexes\IndexInterface;

class IndexCollection implements \JsonSerializable
{
    private $collection = [];

    public function add(IndexInterface $column)
    {
        $this->collection[] = $column;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->collection;
    }
}