<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\Column;

class ColumnFactory
{
    public function fromStdClass(\StdClass $source)
    {
        return new Column(
            $source->name,
            $source->dataType
        );
    }
}