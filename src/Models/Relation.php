<?php

namespace SlytherinCz\SlyGen\Models;

class Relation
{
    const ONE_TO_ONE = '121';

    const ONE_TO_MANY = '12M';

    const MANY_TO_MANY = 'M2N';

    /** @var  string */
    private $type;

    /** @var  string */
    private $reference;

    /** @var  string */
    private $through;

    /**
     * @param string $type
     * @param string $reference
     * @param string $through
     */
    public function __construct(string $type,string $reference,string $through = NULL)
    {
        if($type === self::MANY_TO_MANY && $through === null) {
            throw new \InvalidArgumentException('Many to many relation must have defined joining table');
        }
        $this->type = $type;
        $this->reference = $reference;
        $this->through = $through;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getThrough(): string
    {
        return $this->through;
    }


}