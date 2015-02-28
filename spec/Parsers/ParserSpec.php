<?php

namespace spec\FileModifier\Parsers;

use FileModifier\Code\Entities\PHPNamespace;
use FileModifier\Code\Factory\CodeFactoryContract;
use FileModifier\Errors\PHPErrorThrowerContract;
use FileModifier\File\File;
use FileModifier\Parsers\Parser;
use PhpParser\Node\Name;
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
}
