<?php

namespace spec\FileModifier;

use FileModifier\Code\Generator\GeneratorContract;
use FileModifier\File\File;
use FileModifier\File\FileFactoryContract;
use FileModifier\FileModifier;
use League\Flysystem\Filesystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class FileModifierSpec
 *
 * @package spec\FileModifier
 * @mixin FileModifier
 */
class FileModifierSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileFactoryContract $fileFactory, GeneratorContract $generator)
    {
        $this->beConstructedWith($fileFactory, $filesystem, $generator);
    }

    /**
     * Open files
     */
    function it_open_files(Filesystem $filesystem, FileFactoryContract $fileFactory, File $file)
    {
        $filesystem->read($path = 'MyFile.php')->willReturn($contents = 'Foo contents')->shouldBeCalled();
        $fileFactory->build($contents)->willReturn($file)->shouldBeCalled();
        $this->open($path)->shouldReturn($file);
    }

    /**
     * Save files
     */
    function it_save_files(File $file, Filesystem $filesystem, GeneratorContract $generator)
    {
        $generator->generate($file)->willReturn($code = 'foo')->shouldBeCalled();
        $filesystem->put('MyFile.php', $code);
        $this->save($file, 'MyFile.php');
    }
}
