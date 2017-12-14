<?php


namespace SlytherinCz\SlyGen\Models\Indexes;


trait IndexTrait
{
    /**
     * @return mixed
     */
    public function getColumn() : string
    {
        return $this->column;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return self::TYPE;
    }
}