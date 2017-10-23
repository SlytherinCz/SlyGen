<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\ColumnCollection;

class ColumnCollectionFactory
{
    /** @var  ColumnFactory */
    private $columnFactory;

    /**
     * @param ColumnFactory $columnFactory
     */
    public function __construct(ColumnFactory $columnFactory)
    {
        $this->columnFactory = $columnFactory;
    }

    public function fromArray(array $source)
    {
        $collection = new ColumnCollection();
        foreach($source as $column)
        {
            $collection->add($this->columnFactory->fromStdClass($column));
        }
        return $collection;
    }
}