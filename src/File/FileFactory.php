<?php

namespace FileModifier\File;

use FileModifier\Code\Factory\CodeFactoryContract;
use FileModifier\Parsers\ParserContract;
use PhpParser\Parser;

class FileFactory implements FileFactoryContract
{

    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var CodeFactoryContract
     */
    private $codeFactory;

    /**
     * @var Parser
     */
    private $PHPParser;

    /**
     * Construct a new FileFactory object
     *
     * @param ParserContract      $parser
     * @param Parser              $PHPParser
     * @param CodeFactoryContract $codeFactory
     */
    public function __construct(ParserContract $parser, Parser $PHPParser, CodeFactoryContract $codeFactory)
    {
        $this->parser      = $parser;
        $this->codeFactory = $codeFactory;
        $this->PHPParser   = $PHPParser;
    }

    /**
     * @param string $contents
     *
     * @return File
     */
    public function build($contents)
    {
        $file = new File();
        $file->addNamespace($this->codeFactory->buildNamespace());

        $nodes = $this->PHPParser->parse($contents);
        $this->parser->parse($nodes, $file);

        return $file;
    }
}
