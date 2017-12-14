<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Models\OptionCollection;

class OptionCollectionFactory
{
    /** @var OptionFactory */
    private $optionFactory;

    /**
     * @param OptionFactory $optionFactory
     */
    public function __construct(OptionFactory $optionFactory)
    {
        $this->optionFactory = $optionFactory;
    }

    public function fromArray(array $source)
    {
        $collection = new OptionCollection();
        foreach ($source as $index)
        {
            $collection->add($this->optionFactory->fromStdClass($index));
        }
        return $collection;
    }
}