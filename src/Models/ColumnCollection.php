<?php

namespace SlytherinCz\SlyGen\Models;

class ColumnCollection implements \JsonSerializable
{
    private $collection = [];

    public function add(Column $column)
    {
        $this->collection[] = $column;
    }

    public function jsonSerialize()
    {
        return $this->collection;
    }
}