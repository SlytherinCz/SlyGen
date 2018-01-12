<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\Relation;

class RelationFactory
{
    public function fromStdClass(\StdClass $source)
    {
        return new Relation(
            $source->type,
            $source->reference,
            $source->through
        );
    }
}