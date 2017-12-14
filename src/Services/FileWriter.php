<?php

namespace SlytherinCz\SlyGen\Services;

use SlytherinCz\SlyGen\Exceptions\FileWriterException;
use SlytherinCz\SlyGen\Models\FileBlueprint;

class FileWriter
{
    public function write(FileBlueprint $file,string $contextPath)
    {
        $path = $contextPath.DIRECTORY_SEPARATOR.$file->getPath();

        if(!is_dir($path))
        {
            mkdir($path);
        }

        if(!is_writable($path))
        {
            throw new FileWriterException('Path '.$path.' is not writable');
        }

        file_put_contents($path.DIRECTORY_SEPARATOR.$file->getFilename(),$file->getBody());
    }
}