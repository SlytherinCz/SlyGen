<?php

namespace SlytherinCz\SlyGen\Models;

class Resource implements \JsonSerializable
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var ColumnCollection
     */
    private $columnCollection;
    /**
     * @var IndexCollection
     */
    private $indexCollection;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ColumnCollection
     */
    public function getColumnCollection(): ColumnCollection
    {
        return $this->columnCollection;
    }

    /**
     * @return IndexCollection
     */
    public function getIndexCollection(): IndexCollection
    {
        return $this->indexCollection;
    }

    /**
     */
    public function __construct(string $name,ColumnCollection $columnCollection,IndexCollection $indexCollection)
    {
        $this->name = $name;
        $this->columnCollection = $columnCollection;
        $this->indexCollection = $indexCollection;
    }

    public function jsonSerialize()
    {
        $output = new \StdClass();
        $output->name = $this->getName();
        $output->columns = $this->getColumnCollection();
        $output->indexes = $this->getIndexCollection();
        return $output;
    }
}