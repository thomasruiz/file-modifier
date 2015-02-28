<?php

namespace spec\FileModifier\Code\Entities;

use FileModifier\Code\Entities\PHPProperty;
use FileModifier\Code\Factory\CodeFactoryContract;
use Prophecy\Argument;
use spec\FileModifier\Code\Entities\Partials\ClassMemberSpec;

/**
 * Class PHPPropertySpec
 *
 * @package spec\FileModifier\Code\Entities
 * @mixin PHPProperty
 */
class PHPPropertySpec extends ClassMemberSpec
{
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
     * Has a default value
     */
    function it_has_a_default_value()
    {
        $this->setDefaultValue(3)->shouldReturn($this);
        $this->getDefaultValue()->shouldBe(3);
    }
}
