<?php

namespace spec\FileModifier\Errors;

use FileModifier\Errors\PHPErrorThrower;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PHPErrorThrowerSpec
 *
 * @package spec\FileModifier\Errors
 * @mixin PHPErrorThrower
 */
class PHPErrorThrowerSpec extends ObjectBehavior
{
    function letgo()
    {
        restore_error_handler();
    }

    /**
     * Can trigger warning
     */
    function it_triggers_warning()
    {
        set_error_handler(function ($errno, $errstr) {
            throw new \Exception($errstr);
        }, E_USER_WARNING);

        $this->shouldThrow(new \Exception('ok'))->duringWarning('ok');
    }
}
