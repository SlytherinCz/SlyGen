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
     * @var
     */
    private $credentials;
    /**
     * @var string
     */
    private $outputFolder;

    /**
     * @param string $databaseType
     * @param string $driver
     * @param string $name
     * @param $credentials
     * @param string $outputFolder
     * @param ResourceCollection $resourceCollection
     */
    public function __construct(
        string $databaseType,
        string $driver,
        string $name,
        $credentials,
        string $outputFolder,
        ResourceCollection $resourceCollection
    ) {
        $this->databaseType = $databaseType;
        $this->driver = $driver;
        $this->resourceCollection = $resourceCollection;
        $this->name = $name;
        $this->credentials = $credentials;
        $this->outputFolder = $outputFolder;
    }

    /**
     * @return mixed
     */
    public function getCredentials()
    {
        return $this->credentials;
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

    /**
     * @return \StdClass
     */
    public function jsonSerialize()
    {
        $output = new \StdClass();
        $output->type = $this->getDatabaseType();
        $output->driver = $this->getDriver();
        $output->name = $this->getName();
        $output->credentials = $this->getCredentials();
        $output->resources = $this->getResourceCollection();
        $output->outputFolder = $this->getOutputFolder();
        return $output;
    }

    /**
     * @return string
     */
    public function getOutputFolder() : string
    {
        return $this->outputFolder;
    }
}