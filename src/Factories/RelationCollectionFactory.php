<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\RelationCollection;

class RelationCollectionFactory
{

    /** @var  RelationFactory */
    private $relationFactory;

    /**
     * @param RelationFactory $relationFactory
     */
    public function __construct(RelationFactory $relationFactory)
    {
        $this->relationFactory = $relationFactory;
    }

    public function fromArray(array $source)
    {
        $collection = new RelationCollection();
        foreach ($source as $relation){
            $collection->add(
                $this->relationFactory->fromStdClass($relation)
            );
        }
        return $collection;
    }
}