<?php namespace FileModifier\Code\Generator;

use FileModifier\Code\Entities\PHPNamespace;
use FileModifier\File\File;
use PhpParser\BuilderFactory;
use PhpParser\PrettyPrinterAbstract;

class Generator implements GeneratorContract
{

    /**
     * @var BuilderFactory
     */
    private $factory;

    /**
     * @var PrettyPrinterAbstract
     */
    private $printer;

    /**
     * Construct a new Generator object
     *
     * @param BuilderFactory        $factory
     * @param PrettyPrinterAbstract $printer
     */
    public function __construct(BuilderFactory $factory, PrettyPrinterAbstract $printer)
    {
        $this->factory = $factory;
        $this->printer = $printer;
    }

    /**
     * @param File $file
     *
     * @return mixed
     */
    public function generate(File $file)
    {
        $nodes      = [ ];
        $namespaces = $file->getNamespaces();
        foreach ($namespaces as $namespace) {
            $nodes[] = $this->generateNamespace($namespace);
        }

        return $this->printer->prettyPrintFile($nodes);
    }

    /**
     * @param PHPNamespace $namespace
     *
     * @return \PhpParser\Node
     */
    public function generateNamespace(PHPNamespace $namespace)
    {
        $ns = $this->factory->namespace($namespace->getName());

        return $ns->getNode();
    }
}
