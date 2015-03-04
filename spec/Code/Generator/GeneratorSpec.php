<?php

namespace spec\FileModifier\Code\Generator;

use FileModifier\Code\Entities\PHPNamespace;
use FileModifier\Code\Generator\Generator;
use FileModifier\File\File;
use PhpParser\BuilderFactory;
use PhpParser\PrettyPrinterAbstract;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class GeneratorSpec
 *
 * @package spec\FileModifier\Code\Generator
 * @mixin Generator
 */
class GeneratorSpec extends ObjectBehavior
{

    private $factory;

    function let(PrettyPrinterAbstract $printer)
    {
        // Cannot be mocked: @see https://github.com/phpspec/prophecy/issues/164
        $factory = new BuilderFactory();
        $this->beConstructedWith($factory, $printer);
    }

    /**
     * Generates code
     */
    function it_generates_code(File $file, PrettyPrinterAbstract $printer)
    {
        $factory = new BuilderFactory();

        $file->getNamespaces()->willReturn([ new PHPNamespace('test') ]);
        $printer->prettyPrintFile([ $factory->namespace('test')->getNode() ])->willReturn('foo')->shouldBeCalled();
        $this->generate($file)->shouldReturn('foo');
    }
}
