<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\ResourceCollection;

class ResourceCollectionFactory
{
    /** @var  ResourceFactory */
    private $resourceFactory;

    /**
     * @param ResourceFactory $resourceFactory
     */
    public function __construct(ResourceFactory $resourceFactory)
    {
        $this->resourceFactory = $resourceFactory;
    }

    public function fromArray(array $source)
    {
        $collection = new ResourceCollection();
        foreach ($source as $resource){
            $collection->add(
                $this->resourceFactory->fromStdClass($resource)
            );
        }
        return $collection;
    }

}