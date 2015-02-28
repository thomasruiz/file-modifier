<?php

namespace FileModifier\Code\Factory;

use FileModifier\Code\Entities\PHPMethod;
use FileModifier\Code\Entities\PHPNamespace;
use FileModifier\Code\Entities\PHPProperty;

interface CodeFactoryContract
{

    /**
     * Create a method
     *
     * @param string   $name
     * @param string[] $parameters
     * @param string   $definition
     * @param int      $modifiers
     *
     * @return PHPMethod
     */
    public function buildMethod($name, $parameters, $definition, $modifiers = 0);

    /**
     * Create a property
     *
     * @param string $name
     * @param int    $modifiers
     *
     * @return PHPProperty
     */
    public function buildProperty($name, $modifiers = 0);

    /**
     * @param int|string $name
     *
     * @return PHPNamespace
     */
    public function buildNamespace($name = PHPNamespace::NO_NAMESPACE);
}
