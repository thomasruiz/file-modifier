<?php namespace spec\FileModifier\Code\Entities\Partials;

use FileModifier\Code\Entities\Partials\ClassMember;
use FileModifier\Code\Factory\CodeFactoryContract;
use PhpSpec\ObjectBehavior;
use spec\FileModifier\Code\Entities\Traits\StaticSpecTrait;

/**
 * Class ClassMemberSpec
 *
 * @package spec\FileModifier\Code\Entities\Partials
 * @mixin ClassMember
 */
abstract class ClassMemberSpec extends ObjectBehavior
{
    use StaticSpecTrait;

    function let(CodeFactoryContract $factory)
    {
        $this->beConstructedWith('fooMethod', $factory);
    }

    /**
     * Has a name
     */
    function it_has_a_name()
    {
        $this->getName()->shouldBe('fooMethod');
    }

    /**
     * Has a visibility
     */
    function it_has_a_visibility()
    {
        $this->getVisibility()->shouldBe(null);
        $this->setVisibility(ClassMember::IS_PUBLIC);
        $this->getVisibility()->shouldBe(ClassMember::IS_PUBLIC);
        $this->shouldThrow('\InvalidArgumentException')->duringSetVisibility(ClassMember::IS_PUBLIC | ClassMember::IS_PROTECTED);
    }
}
