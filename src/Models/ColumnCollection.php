<?php

namespace SlytherinCz\SlyGen\Models;

use IteratorAggregate;
use Traversable;

class ColumnCollection implements CollectionInterface
{
    use CollectionTrait;

    public function add(Column $column)
    {
        $this->collection[] = $column;
    }
}