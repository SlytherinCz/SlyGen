<?php

namespace SlytherinCz\SlyGen\Models;

class Route
{
    /** @var  string */
    private $name;

    /** @var  string */
    private $path;

    /** @var  string */
    private $controller;

    /** @var  array */
    private $methods;

    /**
     * @param string $name
     * @param string $path
     * @param string $controller
     * @param array $methods
     */
    public function __construct(string $name,string $path,string $controller, array $methods)
    {
        $this->name = $name;
        $this->path = $path;
        $this->controller = $controller;
        $this->methods = $methods;
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
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }


}