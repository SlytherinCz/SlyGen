<?php

namespace SlytherinCz\SlyGen\Models;

class Schema implements \JsonSerializable
{
    /** @var string */
    private $databaseType;

    /** @var string */
    private $driver;

    /**
     * @var ResourceCollection
     */
    private $resourceCollection;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $databaseType
     * @param string $driver
     * @param string $name
     * @param ResourceCollection $resourceCollection
     */
    public function __construct(
        string $databaseType,
        string $driver,
        string $name,
        ResourceCollection $resourceCollection
    ) {
        $this->databaseType = $databaseType;
        $this->driver = $driver;
        $this->resourceCollection = $resourceCollection;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDatabaseType(): string
    {
        return $this->databaseType;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @return ResourceCollection
     */
    public function getResourceCollection(): ResourceCollection
    {
        return $this->resourceCollection;
    }

    public function jsonSerialize()
    {
        $output = new \StdClass();
        $output->type = $this->getDatabaseType();
        $output->driver = $this->getDriver();
        $output->name = $this->getName();
        $output->resources = $this->getResourceCollection();
        return $output;
    }
}