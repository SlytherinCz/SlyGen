<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\Indexes\ForeignKeyIndex;

/**
 * Class ForeignKeyIndexFactory
 * @package SlytherinCz\SlyGen\Factories
 */
class ForeignKeyIndexFactory implements IndexFactoryInterface
{
    /**
     * @param \StdClass $source
     * @return ForeignKeyIndex
     */
    public static function fromStdClass(\StdClass $source)
    {
        return new ForeignKeyIndex(
            $source->column,
            $source->referencesColumn,
            $source->referencesTable,
            $source->onDelete,
            $source->onUpdate
        );
    }

    /**
     * @param string
     * @return bool
     */
    public function supports(string $type) : bool
    {
        return $type === ForeignKeyIndex::TYPE;
    }
}