<?php

namespace SlytherinCz\SlyGen\Models;

class Column implements \JsonSerializable
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $dataType;

    public function __construct(string $name, string $dataType)
    {
        $this->name = $name;
        $this->dataType = $dataType;
    }

    public static function fromStdClass(\StdClass $source)
    {
        return new self(
            $source->name,
            $source->dataType
        );
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
    public function getDataType(): string
    {
        return $this->dataType;
    }

    public function jsonSerialize()
    {
        $output = new \StdClass();
        $output->name = $this->getName();
        $output->dataType = $this->getDataType();
        return $output;
    }
}