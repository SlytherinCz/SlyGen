<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\Schema;

class SchemaFactory
{
    /** @var  ResourceCollectionFactory */
    private $resourceCollectionFactory;

    /**
     * @param ResourceCollectionFactory $resourceCollectionFactory
     */
    public function __construct(ResourceCollectionFactory $resourceCollectionFactory)
    {
        $this->resourceCollectionFactory = $resourceCollectionFactory;
    }

    /**
     * @param \StdClass $source
     * @return Schema
     */
    public function fromStdClass(\StdClass $source)
    {
        return new Schema(
            $source->type,
            $source->driver,
            $source->name,
            $this->resourceCollectionFactory->fromArray($source->resources)
        );
    }

}