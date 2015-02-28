<?php

namespace spec\FileModifier\Code\Factory;

use FileModifier\Code\Entities\PHPMethod;
use FileModifier\Code\Entities\PHPProperty;
use FileModifier\Code\Factory\CodeFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CodeFactorySpec
 *
 * @package spec\FileModifier\Code\Factory
 * @mixin CodeFactory
 */
class CodeFactorySpec extends ObjectBehavior
{
    /**
     * Can create namespace
     */
    function it_can_create_namespace()
    {
        $namespace = $this->buildNamespace($name = 'foo');
        $namespace->shouldBeAnInstanceOf('FileModifier\Code\Entities\PHPNamespace');
        $namespace->getName()->shouldBe($name);
    }

    /**
     * Can create method
     */
    function it_can_create_method()
    {
        $modifiers = PHPMethod::IS_PUBLIC | PHPMethod::IS_ABSTRACT | PHPMethod::IS_FINAL | PHPMethod::IS_STATIC;
        $method    = $this->buildMethod('foo', [ 'Foo $foo' ], 'return $this;', $modifiers);
        $method->shouldBeAnInstanceOf('FileModifier\Code\Entities\PHPMethod');
        $method->getName()->shouldBe('foo');
        $method->getParameters()->shouldBe([ 'Foo $foo' ]);
        $method->getDefinition()->shouldBe('return $this;');
        $method->getVisibility()->shouldBe(PHPMethod::IS_PUBLIC);
        $method->isStatic()->shouldBe(true);
        $method->isAbstract()->shouldBe(true);
    }

    /**
     * Can create property
     */
    function it_can_create_property()
    {
        $property = $this->buildProperty('foo', PHPProperty::IS_PROTECTED | PHPProperty::IS_STATIC);
        $property->shouldBeAnInstanceOf('\FileModifier\Code\Entities\PHPProperty');
        $property->getName()->shouldBe('foo');
        $property->getVisibility()->shouldBe(PHPMethod::IS_PROTECTED);
        $property->isStatic()->shouldBe(true);
    }
}
