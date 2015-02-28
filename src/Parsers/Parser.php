<?php namespace FileModifier\Parsers;

use FileModifier\Code\Factory\CodeFactoryContract;
use FileModifier\Errors\PHPErrorThrowerContract;
use FileModifier\File\File;
use PhpParser\Lexer;
use PhpParser\Node;
use PhpParser\Node\Stmt\Namespace_;

class Parser implements ParserContract
{

    /**
     * @var array
     */
    private $types = [
        'Stmt_Namespace' => 'Namespace',
    ];

    /**
     * @var CodeFactoryContract
     */
    private $codeFactory;

    /**
     * @var PHPErrorThrowerContract
     */
    private $errorThrower;

    /**
     * Construct a new Parser object
     *
     * @param CodeFactoryContract     $codeFactory
     * @param PHPErrorThrowerContract $errorThrower
     */
    public function __construct(CodeFactoryContract $codeFactory, PHPErrorThrowerContract $errorThrower)
    {
        $this->codeFactory = $codeFactory;
        $this->errorThrower = $errorThrower;
    }

    /**
     * @param Node[] $nodes
     * @param mixed  $target
     */
    public function parse(array $nodes, $target)
    {
        foreach ($nodes as $node) {
            $type = $node->getType();
            if (isset($this->types[$type])) {
                $this->{"handle{$this->types[$type]}"}($node, $target);
            } else {
                $this->errorThrower->warning("Ignored node: $type.");
            }
        }
    }

    /**
     * @param Namespace_ $node
     * @param File       $target
     */
    public function handleNamespace(Namespace_ $node, File $target)
    {
        $name      = $node->name;
        $namespace = $this->codeFactory->buildNamespace($name);
        $target->addNamespace($namespace);
        $this->parse($node->stmts, $namespace);
    }
}
