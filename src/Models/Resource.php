<?php

namespace SlytherinCz\SlyGen\Models;

use SlytherinCz\SlyGen\Helpers\NamespaceDictionary;
use SlytherinCz\SlyGen\Helpers\ResourceControllerNameHelper;
use SlytherinCz\SlyGen\Helpers\ResourceModelNameHelper;

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
     * @var string
     */
    private $namespace;
    /**
     * @var RelationCollection
     */
    private $relationCollection;
    /**
     * @var string
     */
    private $plural;

    /**
     * @param string $name
     * @param string $plural
     * @param string $namespace
     * @param ColumnCollection $columnCollection
     * @param IndexCollection $indexCollection
     * @param OptionCollection $optionCollection
     * @param RelationCollection $relationCollection
     */
    public function __construct(
        string $name,
        string $plural,
        string $namespace,
        ColumnCollection $columnCollection,
        IndexCollection $indexCollection,
        OptionCollection $optionCollection,
        RelationCollection $relationCollection
    ) {
        $this->name = $name;
        $this->columnCollection = $columnCollection;
        $this->indexCollection = $indexCollection;
        $this->optionCollection = $optionCollection;
        $this->namespace = $namespace;
        $this->relationCollection = $relationCollection;
        $this->plural = $plural;
    }

    /**
     * @return string
     */
    public function getModelClassName(): string
    {
        return ResourceModelNameHelper::getModelName($this->getName());
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
    public function getFullyQualifiedControllerClassName(): string
    {
        return $this->getNamespace() . '\\' . NamespaceDictionary::CONTROLLER . '\\' . $this->getControllerClassName();
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getControllerClassName(): string
    {
        return ResourceControllerNameHelper::getControllerName($this->getName());
    }

    /**
     * @return string
     */
    public function getPlural(): string
    {
        return $this->plural;
    }

    /**
     * @return OptionCollection
     */
    public function getOptionCollection(): OptionCollection
    {
        return $this->optionCollection;
    }

    /**
     * @return \StdClass
     */
    public function jsonSerialize()
    {
        $output = new \StdClass();
        $output->namespace = $this->getNamespace();
        $output->name = $this->getName();
        $output->columns = $this->getColumnCollection();
        $output->indexes = $this->getIndexCollection();
        $output->relations = $this->getRelationCollection();
        return $output;
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
     * @return RelationCollection
     */
    public function getRelationCollection(): RelationCollection
    {
        return $this->relationCollection;
    }

    /**
     * @return bool
     */
    public function hasRelation(): bool
    {
        return !$this->getRelationCollection()->isEmpty();
    }
}