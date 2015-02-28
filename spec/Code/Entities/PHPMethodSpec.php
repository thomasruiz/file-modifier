<?php

namespace spec\FileModifier\Code\Entities;

use FileModifier\Code\Entities\PHPMethod;
use FileModifier\Code\Factory\CodeFactoryContract;
use Prophecy\Argument;
use spec\FileModifier\Code\Entities\Partials\ClassMemberSpec;
use spec\FileModifier\Code\Entities\Traits\AbstractSpecTrait;
use spec\FileModifier\Code\Entities\Traits\FinalSpecTrait;

/**
 * Class PHPMethodSpec
 *
 * @package spec\FileModifier\Code\Entities
 * @mixin PHPMethod
 */
class PHPMethodSpec extends ClassMemberSpec
{

    use AbstractSpecTrait, FinalSpecTrait;

    function let(CodeFactoryContract $factory)
    {
        $this->beConstructedWith('fooMethod', $factory);
    }

    /**
     * Is a class member
     */
    function it_is_a_class_member()
    {
        $this->shouldHaveType('\FileModifier\Code\Entities\Partials\ClassMember');
    }

    /**
     * Has parameters
     */
    function it_has_parameters()
    {
        $this->parameter('$foo', 'Foo\Bar $bar', '$baz = 0')->shouldReturn($this);
        $this->getParameters()->shouldBe([ '$foo', 'Foo\Bar $bar', '$baz = 0' ]);
    }

    /**
     * Has a definition
     */
    function it_has_a_definition()
    {
        $this->definition('return $this;')->shouldReturn($this);
        $this->getDefinition()->shouldReturn('return $this;');
    }
}
