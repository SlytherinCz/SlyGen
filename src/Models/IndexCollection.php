<?php

namespace SlytherinCz\SlyGen\Models;

use SlytherinCz\SlyGen\Models\Indexes\IndexInterface;

class IndexCollection implements CollectionInterface
{
    use CollectionTrait;

    public function add(IndexInterface $column)
    {
        $this->collection[] = $column;
    }
}