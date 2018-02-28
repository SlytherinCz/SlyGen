<?php

namespace SlytherinCz\SlyGen\Services;

use SlytherinCz\SlyGen\Exceptions\FileWriterException;
use SlytherinCz\SlyGen\Models\FileBlueprint;

class FileWriter
{
    public function write(FileBlueprint $file, string $contextPath)
    {
        $path = $contextPath . DIRECTORY_SEPARATOR . $file->getPath();

        if (!is_dir($path)) {
            if(!mkdir($path)) {
                $currentDepthPath = "";
                $pathFragments = explode(DIRECTORY_SEPARATOR,$file->getPath());
                array_walk($pathFragments,function($pathFragment) use (&$currentDepthPath,$contextPath) {
                    mkdir($contextPath.DIRECTORY_SEPARATOR.$currentDepthPath.DIRECTORY_SEPARATOR.$pathFragment);
                    $currentDepthPath = $currentDepthPath.DIRECTORY_SEPARATOR.$pathFragment;
                });
            }
        }

        if (!is_writable($path)) {
            throw new FileWriterException('Path ' . $path . ' is not writable');
        }

        file_put_contents($path . DIRECTORY_SEPARATOR . $file->getFilename(), $file->getBody());
    }
}