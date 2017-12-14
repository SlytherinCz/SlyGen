<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\Indexes\UniqueIndex;

class UniqueIndexFactory implements IndexFactoryInterface
{

    public function supports(string $type): bool
    {
        return $type === UniqueIndex::TYPE;
    }

    public function fromStdClass(\StdClass $source)
    {
        return new UniqueIndex(
            $source->column
        );
    }
}