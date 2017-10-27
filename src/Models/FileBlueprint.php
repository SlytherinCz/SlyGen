<?php

namespace SlytherinCz\SlyGen\Models;

class FileBlueprint
{
    private $filename;

    private $path;

    private $body;

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param $filename
     * @param $path
     * @param $body
     */
    public function __construct($filename, $path, $body)
    {
        $this->filename = $filename;
        $this->path = $path;
        $this->body = $body;
    }
}