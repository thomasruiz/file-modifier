<?php

namespace spec\FileModifier\Code\Entities;

use FileModifier\Code\Entities\PHPClass;
use FileModifier\Code\Entities\PHPMethod;
use FileModifier\Code\Entities\PHPProperty;
use FileModifier\Code\Factory\CodeFactoryContract;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\FileModifier\Code\Entities\Traits\AbstractSpecTrait;
use spec\FileModifier\Code\Entities\Traits\FinalSpecTrait;

/**
 * Class PHPClassSpec
 *
 * @package spec\FileModifier\Code\Entities
 * @mixin PHPClass
 */
class PHPClassSpec extends ObjectBehavior
{

    use AbstractSpecTrait, FinalSpecTrait;

    function let(CodeFactoryContract $factory)
    {
        $this->beConstructedWith('FooClass', $factory);
    }

    /**
     * Has a name
     */
    function it_has_a_name()
    {
        $this->getName()->shouldReturn('FooClass');
    }

    /**
     * Extends some other class
     */
    function it_extends_some_other_class()
    {
        $this->extend('ParentClass')->shouldReturn($this);
        $this->getExtendedClass()->shouldBe('ParentClass');
    }

    /**
     * Implements multiple classes
     */
    function it_implements_multiple_classes()
    {
        $this->implement('SomeClass', 'FooContract')->shouldReturn($this);
        $this->implement([ 'FooInterface' ])->shouldReturn($this);
        $this->getImplementedClasses()->shouldBe([ 'SomeClass', 'FooContract', 'FooInterface' ]);
    }

    /**
     * Uses multiple traits
     */
    function it_uses_multiple_traits()
    {
        $this->uses('Foo', 'Bar')->shouldReturn($this);
        $this->uses([ 'Baz' ])->shouldReturn($this);
        $this->getTraits()->shouldBe([ 'Foo', 'Bar', 'Baz' ]);
    }

    /**
     * Customize usedtraits
     */
    function it_customize_used_traits()
    {
        $this->uses('Foo');
        $this->with('fooMethod as protected', 'B::barMethod as selected')->shouldReturn($this);
        $this->with([ 'fooMethod as public', 'A::bar insteadof B' ])->shouldReturn($this);
        $this->getTraitCustomization()->shouldReturn(
            [ 'fooMethod as protected', 'B::barMethod as selected', 'fooMethod as public', 'A::bar insteadof B' ]
        );
    }

    /**
     * Add methods
     */
    function it_add_methods(CodeFactoryContract $factory, PHPMethod $method)
    {
        $factory->buildMethod($name = 'foo', $parameters = [ 'FooClass $p1' ], $modifiers = 'bar')
                ->willReturn($method)
                ->shouldBeCalled();
        $this->method($name, $parameters, $modifiers)->shouldReturn($this);
        $this->getMethods()->shouldBe([ $method ]);
    }

    /**
     * Add properties
     */
    function it_add_properties(CodeFactoryContract $factory, PHPProperty $property)
    {
        $factory->buildProperty($name = 'foo', $modifiers = 'bar')->willReturn($property)->shouldBeCalled();
        $this->property($name, $modifiers)->shouldReturn($this);
        $this->getProperties()->shouldBe([ $property ]);
    }
}
