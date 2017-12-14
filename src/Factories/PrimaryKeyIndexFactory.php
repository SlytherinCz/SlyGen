<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\Indexes\PrimaryKeyIndex;

/**
 * Class PrimaryKeyIndexFactory
 * @package SlytherinCz\SlyGen\Factories
 */
class PrimaryKeyIndexFactory implements IndexFactoryInterface
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
     * @param string
     * @return bool
     */
    public function supports(string $type) : bool
    {
        return $type === PrimaryKeyIndex::TYPE;
    }
}