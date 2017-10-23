<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\Indexes\PrimaryKeyIndex;

/**
 * Class PrimaryKeyIndexFactory
 * @package SlytherinCz\SlyGen\Factories
 */
class PrimaryKeyIndexFactory
{
    /**
     * @param \StdClass $source
     * @return PrimaryKeyIndex
     */
    public static function fromStdClass(\StdClass $source)
    {
        return new PrimaryKeyIndex($source->column);
    }

    /**
     * @return string
     */
    public function supports()
    {
        return PrimaryKeyIndex::TYPE;
    }
}