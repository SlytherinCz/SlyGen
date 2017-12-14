<?php

namespace SlytherinCz\SlyGen\Models\Indexes;

class UniqueIndex implements IndexInterface
{
    const TYPE = 'unique';

    use IndexTrait;

    /** @var  string */
    private $column;

    /**
     * @param string $column
     */
    public function __construct($column)
    {
        $this->column = $column;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }
}