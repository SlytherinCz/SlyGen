<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\Resource;

class ResourceFactory
{
    /**
     * @var IndexCollectionFactory
     */
    private $indexCollectionFactory;

    /**
     * @var ColumnCollectionFactory
     */
    private $columnCollectionFactory;


    /**
     * @param ColumnCollectionFactory $columnCollectionFactory
     * @param IndexCollectionFactory $indexCollectionFactory
     */
    public function __construct(
        ColumnCollectionFactory $columnCollectionFactory,
        IndexCollectionFactory $indexCollectionFactory
    ) {
        $this->indexCollectionFactory = $indexCollectionFactory;
        $this->columnCollectionFactory = $columnCollectionFactory;
    }

    public function fromStdClass(\StdClass $source)
    {
        return new Resource(
            $source->name,
            $this->columnCollectionFactory->fromArray($source->columns),
            $this->indexCollectionFactory->fromArray($source->indexes)
        );
    }
}