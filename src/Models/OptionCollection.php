<?php

namespace SlytherinCz\SlyGen\Models;

class OptionCollection implements CollectionInterface
{
    use CollectionTrait;

    public function add(Option $option)
    {
        $this->collection[] = $option;
    }

}