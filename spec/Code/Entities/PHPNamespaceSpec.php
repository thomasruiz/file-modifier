<?php namespace spec\FileModifier\Code\Entities;

use FileModifier\Code\Entities\PHPNamespace;
use PhpSpec\ObjectBehavior;

/**
 * Class PHPNamespaceSpec
 *
 * @package spec\FileModifier\Code\Entities
 * @mixin PHPNamespace
 */
class PHPNamespaceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('foo');
    }

    /**
     * Has a name
     */
    function it_has_a_name()
    {
        $this->getName()->shouldReturn('foo');
        $this->setName('bar')->shouldReturn($this);
        $this->getName()->shouldReturn('bar');
    }

    /**
     * Is empty by default
     */
    function it_is_empty_by_default()
    {
        $this->isEmpty()->shouldReturn(true);
    }
}
