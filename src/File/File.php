<?php namespace FileModifier\File;

use FileModifier\Code\Entities\PHPNamespace;

class File
{

    /**
     * @var PHPNamespace[]
     */
    private $namespaces = [ ];

    /**
     * Construct a new File object
     */
    public function __construct()
    {
    }

    /**
     * @param PHPNamespace $namespace
     */
    public function addNamespace(PHPNamespace $namespace)
    {
        if (isset( $this->namespaces[0] ) && $this->namespaces[0]->getName() === PHPNamespace::NO_NAMESPACE) {
            if ($this->namespaces[0]->isEmpty()) {
                $this->namespaces[0] = $namespace;
            } else {
                $this->namespaces[0]->setName(PHPNamespace::GLOBAL_NAMESPACE);
                $this->namespaces[] = $namespace;
            }
        } else {
            $this->namespaces[] = $namespace;
        }
    }

    /**
     * @return \FileModifier\Code\Entities\PHPNamespace[]
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }
}
