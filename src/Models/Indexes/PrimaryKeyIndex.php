<?php

namespace SlytherinCz\SlyGen\Models\Indexes;

class PrimaryKeyIndex implements IndexInterface, \JsonSerializable
{
    const TYPE = 'primary';

    /** @var string*/
    private $column;

    /**
     * @return mixed
     */
    public function getColumn() : string
    {
        return $this->column;
    }

    /**
     * @param $column
     */
    public function __construct(string $column)
    {
        $this->column = $column;
    }

    public static function fromStdClass(\StdClass $source)
    {
        return new self(
            $source->column
        );
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $output = new \StdClass();
        $output->type = self::TYPE;
        $output->column = $this->getColumn();
        return $output;
    }
}