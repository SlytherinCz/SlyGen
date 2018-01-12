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
     * @var RelationCollectionFactory
     */
    private $relationCollectionFactory;


    /**
     * @param ColumnCollectionFactory $columnCollectionFactory
     * @param IndexCollectionFactory $indexCollectionFactory
     * @param OptionCollectionFactory $optionCollectionFactory
     * @param RelationCollectionFactory $relationCollectionFactory
     */
    public function __construct(
        ColumnCollectionFactory $columnCollectionFactory,
        IndexCollectionFactory $indexCollectionFactory,
        OptionCollectionFactory $optionCollectionFactory,
        RelationCollectionFactory $relationCollectionFactory
    ) {
        $this->indexCollectionFactory = $indexCollectionFactory;
        $this->columnCollectionFactory = $columnCollectionFactory;
        $this->optionCollectionFactory = $optionCollectionFactory;
        $this->relationCollectionFactory = $relationCollectionFactory;
    }

    public function fromStdClass(\StdClass $source)
    {
        return new Resource(
            $source->name,
            $source->plural,
            $source->namespace,
            $this->columnCollectionFactory->fromArray($source->columns),
            $this->indexCollectionFactory->fromArray($source->indexes),
            $this->optionCollectionFactory->fromArray($source->options),
            $this->relationCollectionFactory->fromArray($source->relations)
        );
    }
}