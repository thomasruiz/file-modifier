<?php namespace FileModifier\File;

interface FileFactoryContract
{
    /**
     * @param string $contents
     *
     * @return File
     */
    public function build($contents);
}
