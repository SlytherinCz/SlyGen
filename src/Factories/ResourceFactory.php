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
     * @var OptionCollectionFactory
     */
    private $optionCollectionFactory;


    /**
     * @param ColumnCollectionFactory $columnCollectionFactory
     * @param IndexCollectionFactory $indexCollectionFactory
     */
    public function __construct(
        ColumnCollectionFactory $columnCollectionFactory,
        IndexCollectionFactory $indexCollectionFactory,
        OptionCollectionFactory $optionCollectionFactory
    ) {
        $this->indexCollectionFactory = $indexCollectionFactory;
        $this->columnCollectionFactory = $columnCollectionFactory;
        $this->optionCollectionFactory = $optionCollectionFactory;
    }

    public function fromStdClass(\StdClass $source)
    {
        return new Resource(
            $source->name,
            $this->columnCollectionFactory->fromArray($source->columns),
            $this->indexCollectionFactory->fromArray($source->indexes),
            $this->optionCollectionFactory->fromArray($source->options)
        );
    }
}