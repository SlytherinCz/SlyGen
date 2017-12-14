<?php

namespace SlytherinCz\SlyGen\Factories;

use SlytherinCz\SlyGen\Exceptions\IndexFactoryUnsupportedTypeException;

/**
 * Class IndexFactory
 * @package SlytherinCz\SlyGen\Factories
 */
class IndexFactory
{
    private $factories = [];

    /**
     * @param array $factories
     */
    public function __construct(array $factories)
    {
        $this->factories = $factories;
    }

    public function fromStdClass(\StdClass $source)
    {
        foreach ($this->factories as $factory)
        {
            if ($factory->supports($source->type))
            {
                return $factory->fromStdClass($source);
            }

        }
        throw new IndexFactoryUnsupportedTypeException('Index type '.$source->type.' is not supported');
    }
}