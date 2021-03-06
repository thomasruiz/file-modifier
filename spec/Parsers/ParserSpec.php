<?php

namespace spec\FileModifier\Parsers;

use FileModifier\Code\Entities\PHPClass;
use FileModifier\Code\Entities\PHPNamespace;
use FileModifier\Code\Factory\CodeFactoryContract;
use FileModifier\Errors\PHPErrorThrowerContract;
use FileModifier\File\File;
use FileModifier\Parsers\Parser;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ParserSpec
 *
 * @package spec\FileModifier\Parsers
 * @mixin Parser
 */
class ParserSpec extends ObjectBehavior
{
    function let(CodeFactoryContract $codeFactory, PHPErrorThrowerContract $errorThrower)
    {
        $this->beConstructedWith($codeFactory, $errorThrower);
    }

    /**
     * Parses nodes to entities
     */
    function it_parses_nodes_to_entities(File $file)
    {
        $this->parse([ ], $file);
    }

    /**
     * Handles namespaces
     */
    function it_handles_namespaces(File $file, CodeFactoryContract $codeFactory, PHPNamespace $namespace)
    {
        $namespaceNode = new Namespace_(new Name('A\B'));
        $codeFactory->buildNamespace('A\B')->willReturn($namespace)->shouldBeCalled();
        $file->addNamespace($namespace)->shouldBeCalled();
        $this->parse([ $namespaceNode ], $file);
    }

    /**
     * Passes the namespace instead of the file when handling non namespace node
     */
    function it_passes_the_namespace_instead_of_the_file_when_handling_non_namespace_node(
        File $file, PHPNamespace $namespace, CodeFactoryContract $codeFactory, PHPClass $class
    ) {
        $file->getCurrentNamespace()->willReturn($namespace);

        $classNode = new Class_('Foo');
        $codeFactory->buildClass('Foo', 0)->willReturn($class)->shouldBeCalled();
        $namespace->addClass($class)->shouldBeCalled();
        $this->parse([ $classNode ], $file);
    }

    /**
     * Handles classes
     */
    function it_handles_classes(PHPNamespace $namespace, CodeFactoryContract $codeFactory, PHPClass $class)
    {
        $classNode = new Class_('Foo');
        $codeFactory->buildClass('Foo', 0)->willReturn($class)->shouldBeCalled();
        $namespace->addClass($class)->shouldBeCalled();
        $this->parse([ $classNode ], $namespace);
    }

    /**
     * Handles abstract classes
     */
    function it_handles_abstract_classes(PHPNamespace $namespace, CodeFactoryContract $codeFactory, PHPClass $class)
    {
        $classNode = new Class_('Foo', [ 'type' => Class_::MODIFIER_ABSTRACT ]);
        $codeFactory->buildClass('Foo', PHPClass::IS_ABSTRACT)->willReturn($class)->shouldBeCalled();
        $namespace->addClass($class)->shouldBeCalled();
        $this->parse([ $classNode ], $namespace);
    }

    /**
     * Handles classes
     */
    function it_handles_final_classes(PHPNamespace $namespace, CodeFactoryContract $codeFactory, PHPClass $class)
    {
        $classNode = new Class_('Foo', [ 'type' => Class_::MODIFIER_FINAL ]);
        $codeFactory->buildClass('Foo', PHPClass::IS_FINAL)->willReturn($class)->shouldBeCalled();
        $namespace->addClass($class)->shouldBeCalled();
        $this->parse([ $classNode ], $namespace);
    }
}
