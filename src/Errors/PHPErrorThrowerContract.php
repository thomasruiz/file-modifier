<?php namespace FileModifier\Errors;

interface PHPErrorThrowerContract
{

    /**
     * @param string $string
     */
    public function warning($string);
}
