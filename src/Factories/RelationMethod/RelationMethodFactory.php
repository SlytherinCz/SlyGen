<?php

namespace SlytherinCz\SlyGen\Factories\RelationMethod;

use SlytherinCz\SlyGen\Exceptions\RelationMethodFactoryUnsupportedRelationTypeException;

class RelationMethodFactory
{
    /**
     * @var RelationMethodFactoryInterface[]
     */
    private $factories;

    public function add($relationMethodFactories)
    {
        $this->factories = $relationMethodFactories;
    }

    public function getFactory(string $relationType) : RelationMethodFactoryInterface
    {
        foreach ($this->factories as $factory)
        {
            if($factory->supports($relationType))
            {
                return $factory;
            }
        }
        throw new RelationMethodFactoryUnsupportedRelationTypeException();
    }
}