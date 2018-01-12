<?php

namespace SlytherinCz\SlyGen\Models;

class RelationCollection implements CollectionInterface
{
    use CollectionTrait;

    public function add(Relation $column)
    {
        $this->collection[] = $column;
    }
}