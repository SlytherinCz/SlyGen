<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\Option;

class OptionFactory
{
    public function fromStdClass(\StdClass $source)
    {
        return new Option(
            $source->type,
            $source->value
        );
    }
}