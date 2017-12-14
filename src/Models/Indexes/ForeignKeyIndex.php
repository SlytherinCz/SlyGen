<?php

namespace SlytherinCz\SlyGen\Models\Indexes;

class ForeignKeyIndex implements IndexInterface
{
    const TYPE = 'foreign';

    use IndexTrait;
    /** @var  string */
    private $column;
    /** @var  string */
    private $referencesColumn;
    /** @var  string */
    private $referencesTable;
    /** @var  string */
    private $onUpdate;
    /** @var  string */
    private $onDelete;

    /**
     * @param string $column
     * @param string $referencesColumn
     * @param string $referencesTable
     * @param string $onUpdate
     * @param string $onDelete
     */
    public function __construct($column, $referencesColumn, $referencesTable, $onUpdate, $onDelete)
    {
        $this->column = $column;
        $this->referencesColumn = $referencesColumn;
        $this->referencesTable = $referencesTable;
        $this->onUpdate = $onUpdate;
        $this->onDelete = $onDelete;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @return string
     */
    public function getReferencesColumn(): string
    {
        return $this->referencesColumn;
    }

    /**
     * @return string
     */
    public function getReferencesTable(): string
    {
        return $this->referencesTable;
    }

    /**
     * @return string
     */
    public function getOnUpdate(): string
    {
        return $this->onUpdate;
    }

    /**
     * @return string
     */
    public function getOnDelete(): string
    {
        return $this->onDelete;
    }


}