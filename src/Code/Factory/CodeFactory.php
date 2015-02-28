<?php

namespace FileModifier\Code\Factory;

use FileModifier\Code\Entities\PHPClass;
use FileModifier\Code\Entities\PHPMethod;
use FileModifier\Code\Entities\PHPNamespace;
use FileModifier\Code\Entities\PHPProperty;

class CodeFactory implements CodeFactoryContract
{

    /**
     * @param int|string $name
     *
     * @return PHPNamespace
     */
    public function buildNamespace($name = PHPNamespace::NO_NAMESPACE)
    {
        $namespace = new PHPNamespace($name);

        return $namespace;
    }

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
    public function buildMethod($name, $parameters, $definition, $modifiers = 0)
    {
        $method = new PHPMethod($name, $this);
        $method->parameter($parameters);
        $method->definition($definition);
        $method->setVisibility($modifiers);
        $method->setAbstract($modifiers & PHPMethod::IS_ABSTRACT);
        $method->setFinal($modifiers & PHPMethod::IS_FINAL);
        $method->setStatic($modifiers & PHPMethod::IS_STATIC);

        return $method;
    }

    /**
     * Create a property
     *
     * @param string $name
     * @param int    $modifiers
     *
     * @return PHPProperty
     */
    public function buildProperty($name, $modifiers = 0)
    {
        $property = new PHPProperty($name, $this);
        $property->setVisibility($modifiers);
        $property->setStatic($modifiers & PHPMethod::IS_STATIC);

        return $property;
    }

    /**
     * Create a class
     *
     * @param string $name
     * @param int    $modifiers
     *
     * @return PHPClass
     */
    public function buildClass($name, $modifiers = 0)
    {
        $class = new PHPClass($name, $this);
        $class->setAbstract($modifiers & PHPClass::IS_ABSTRACT);
        $class->setFinal($modifiers & PHPClass::IS_FINAL);

        return $class;
    }
}
