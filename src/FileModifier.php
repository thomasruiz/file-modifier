<?php namespace FileModifier;

use FileModifier\Code\Factory\CodeFactory;
use FileModifier\Code\Generator\Generator;
use FileModifier\Code\Generator\GeneratorContract;
use FileModifier\Errors\PHPErrorThrower;
use FileModifier\File\File;
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
     * @var GeneratorContract
     */
    private $generator;

    /**
     * Construct a new FileModifier object
     *
     * @param FileFactoryContract $fileFactory
     * @param Filesystem          $filesystem
     * @param GeneratorContract   $generator
     */
    public function __construct(FileFactoryContract $fileFactory, Filesystem $filesystem, GeneratorContract $generator)
    {
        $this->filesystem  = $filesystem;
        $this->fileFactory = $fileFactory;
        $this->generator   = $generator;
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
        $generator   = new Generator();

        return new static($fileFactory, $filesystem, $generator);
    }

    /**
     * @param string $path
     *
     * @return File
     */
    public function open($path)
    {
        $contents = $this->filesystem->read($path);

        return $this->fileFactory->build($contents);
    }

    /**
     * @param File   $file
     * @param string $path
     */
    public function save(File $file, $path)
    {
        $code = $this->generator->generate($file);
        $this->filesystem->put($path, $code);
    }
}
