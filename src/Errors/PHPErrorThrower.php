<?php namespace FileModifier\Errors;

class PHPErrorThrower implements PHPErrorThrowerContract
{

    /**
     * @param string $message
     */
    public function warning($message)
    {
        trigger_error($message, E_USER_WARNING);
    }
}
