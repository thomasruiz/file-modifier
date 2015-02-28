<?php namespace FileModifier\Parsers;

use FileModifier\Code\Entities\PHPClass;
use FileModifier\Code\Entities\PHPNamespace;
use FileModifier\Code\Factory\CodeFactoryContract;
use FileModifier\Errors\PHPErrorThrowerContract;
use FileModifier\File\File;
use PhpParser\Lexer;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;

class Parser implements ParserContract
{

    /**
     * @var array
     */
    private $types = [
        'Stmt_Namespace' => 'Namespace',
        'Stmt_Class'     => 'Class',
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
        $this->codeFactory  = $codeFactory;
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
            if (isset( $this->types[ $type ] )) {
                if ($target instanceof File && $type !== 'Stmt_Namespace') {
                    $this->{"handle{$this->types[$type]}"}($node, $target->getCurrentNamespace());
                } else {
                    $this->{"handle{$this->types[$type]}"}($node, $target);
                }
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

    /**
     * @param Class_       $node
     * @param PHPNamespace $target
     */
    public function handleClass(Class_ $node, PHPNamespace $target)
    {
        $name  = $node->name;
        $modifiers = 0;
        $modifiers |= $node->isAbstract() ? PHPClass::IS_ABSTRACT : 0;
        $modifiers |= $node->isFinal() ? PHPClass::IS_FINAL : 0;
        $class = $this->codeFactory->buildClass($name, $modifiers);
        $target->addClass($class);
        $this->parse($node->stmts, $class);
    }
}
