<?php

namespace spec\FileModifier;

use FileModifier\File\File;
use FileModifier\File\FileFactoryContract;
use League\Flysystem\Filesystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileModifierSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileFactoryContract $fileFactory)
    {
        $this->beConstructedWith($fileFactory, $filesystem);
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
}
