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
     *
     * @param PHPNamespace $namespace
     */
    public function __construct(PHPNamespace $namespace)
    {
        $this->namespaces[] = $namespace;
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

    /**
     * @return PHPNamespace
     */
    public function getCurrentNamespace()
    {
        return $this->namespaces[ count($this->namespaces) - 1 ];
    }
}
