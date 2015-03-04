<?php namespace FileModifier\Code\Generator;

use FileModifier\File\File;

interface GeneratorContract
{

    /**
     * @param File $file
     *
     * @return mixed
     */
    public function generate(File $file);
}
