<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\IndexCollection;

class IndexCollectionFactory
{
    /** @var IndexFactory */
    private $indexFactory;

    /**
     * @param IndexFactory $indexFactory
     */
    public function __construct(IndexFactory $indexFactory)
    {
        $this->indexFactory = $indexFactory;
    }

    public function fromArray(array $source)
    {
        $collection = new IndexCollection();
        foreach ($source as $index)
        {
            $collection->add($this->indexFactory->fromStdClass($index));
        }
        return $collection;
    }
}