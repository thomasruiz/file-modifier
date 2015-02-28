<?php

namespace spec\FileModifier\File;

use FileModifier\Code\Entities\PHPNamespace;
use FileModifier\Code\Factory\CodeFactoryContract;
use FileModifier\File\FileFactory;
use FileModifier\Parsers\ParserContract;
use PhpParser\Parser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class FileFactorySpec
 *
 * @package spec\FileModifier\File
 * @mixin FileFactory
 */
class FileFactorySpec extends ObjectBehavior
{
    function let(ParserContract $parser, Parser $PHPParser, CodeFactoryContract $codeFactory)
    {
        $this->beConstructedWith($parser, $PHPParser, $codeFactory);
    }

    /**
     * Build a file
     */
    function it_build_a_file(CodeFactoryContract $codeFactory, PHPNamespace $namespace, Parser $PHPParser, ParserContract $parser)
    {
        $codeFactory->buildNamespace()->willReturn($namespace)->shouldBeCalled();
        $PHPParser->parse('foo')->willReturn([ ]);
        $file = $this->build('foo');
        $file->shouldBeAnInstanceOf('FileModifier\File\File');
        $parser->parse([ ], $file)->shouldHaveBeenCalled();
    }
}
