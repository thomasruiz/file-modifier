<?php namespace FileModifier;

use FileModifier\Code\Factory\CodeFactory;
use FileModifier\Errors\PHPErrorThrower;
use FileModifier\File\FileFactory;
use FileModifier\File\FileFactoryContract;
use FileModifier\Parsers\Parser;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PhpParser\Lexer;
use PhpParser\Parser as PHPParser;

class FileModifier
{

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var FileFactoryContract
     */
    private $fileFactory;

    /**
     * Construct a new FileModifier object
     *
     * @param FileFactoryContract $fileFactory
     * @param Filesystem          $filesystem
     */
    public function __construct(FileFactoryContract $fileFactory, Filesystem $filesystem)
    {
        $this->filesystem  = $filesystem;
        $this->fileFactory = $fileFactory;
    }

    /**
     * @return static
     */
    public static function build()
    {
        $codeFactory = new CodeFactory();
        $parser      = new Parser($codeFactory, new PHPErrorThrower());
        $PHPParser   = new PHPParser(new Lexer());
        $fileFactory = new FileFactory($parser, $PHPParser, $codeFactory);
        $filesystem  = new Filesystem(new Local(getcwd()));

        return new static($fileFactory, $filesystem);
    }

    /**
     * @param string $path
     *
     * @return File\File
     */
    public function open($path)
    {
        $contents = $this->filesystem->read($path);

        return $this->fileFactory->build($contents);
    }
}
