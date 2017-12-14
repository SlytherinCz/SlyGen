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
     * @var OptionCollection
     */
    private $optionCollection;

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
    public function __construct(
        string $name,
        ColumnCollection $columnCollection,
        IndexCollection $indexCollection,
        OptionCollection $optionCollection
    )
    {
        $this->name = $name;
        $this->columnCollection = $columnCollection;
        $this->indexCollection = $indexCollection;
        $this->optionCollection = $optionCollection;
    }

    /**
     * @return OptionCollection
     */
    public function getOptionCollection(): OptionCollection
    {
        return $this->optionCollection;
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