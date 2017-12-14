<?php

namespace SlytherinCz\SlyGen\Models;

class Option
{
    /** @var  string */
    private $type;
    /** @var  string */
    private $value;

    /**
     * @param string $type
     * @param string $value
     */
    public function __construct(string $type,string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}