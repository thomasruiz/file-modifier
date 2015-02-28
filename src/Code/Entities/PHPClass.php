<?php

namespace FileModifier\Code\Entities;

use FileModifier\Code\Entities\Traits\AbstractTrait;
use FileModifier\Code\Entities\Traits\FinalTrait;
use FileModifier\Code\Factory\CodeFactoryContract;

class PHPClass
{
    use AbstractTrait, FinalTrait;

    const IS_ABSTRACT  = 0x01;
    const IS_FINAL     = 0x02;

    /**
     * @var string
     */
    private $name;

    /**
     * @var CodeFactoryContract
     */
    private $codeFactory;

    /**
     * @var PHPMethod[]
     */
    private $methods = [ ];

    /**
     * @var PHPProperty[]
     */
    private $properties = [ ];

    /**
     * @var string
     */
    private $extendedClass;

    /**
     * @var string[]
     */
    private $implementedClasses = [ ];

    /**
     * @var string[]
     */
    private $traits = [ ];

    /**
     * @var string[]
     */
    private $traitCustomization = [ ];

    /**
     * Construct a new PHPClass object
     *
     * @param string              $name
     * @param CodeFactoryContract $codeFactory
     */
    public function __construct($name, CodeFactoryContract $codeFactory)
    {
        $this->name        = $name;
        $this->codeFactory = $codeFactory;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Extend another class
     *
     * @param string $class
     *
     * @return $this
     */
    public function extend($class)
    {
        $this->extendedClass = $class;

        return $this;
    }

    /**
     * Implement some other classes
     *
     * @param string $class,...
     *
     * @return $this
     */
    public function implement($class)
    {
        $classes                  = is_array($class) ? $class : func_get_args();
        $this->implementedClasses = array_merge($this->implementedClasses, $classes);

        return $this;
    }

    /**
     * Use some other traits
     *
     * @param string $trait,...
     *
     * @return $this
     */
    public function uses($trait)
    {
        $traits       = is_array($trait) ? $trait : func_get_args();
        $this->traits = array_merge($this->traits, $traits);

        return $this;
    }

    /**
     * Add customization to used traits
     *
     * @param string $traitCustomization
     *
     * @return $this
     */
    public function with($traitCustomization)
    {
        $traitCustomization       = is_array($traitCustomization) ? $traitCustomization : func_get_args();
        $this->traitCustomization = array_merge($this->traitCustomization, $traitCustomization);

        return $this;
    }

    /**
     * Add a method to the class
     *
     * @param string $method
     * @param array  $parameters
     * @param int    $modifiers
     *
     * @return PHPMethod
     */
    public function method($method, $parameters = [ ], $modifiers = 0)
    {
        $this->methods[] = $this->codeFactory->buildMethod($method, $parameters, $modifiers);

        return $this;
    }

    /**
     * Add a property to the class
     *
     * @param string $name
     * @param int    $modifiers
     *
     * @return $this
     */
    public function property($name, $modifiers = 0)
    {
        $this->properties[] = $this->codeFactory->buildProperty($name, $modifiers);

        return $this;
    }

    /**
     * Get the name of the class
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the methods in the class
     *
     * @return PHPMethod[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * Get the properties of the class
     *
     * @return PHPProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Get the name of the class extended
     *
     * @return string
     */
    public function getExtendedClass()
    {
        return $this->extendedClass;
    }

    /**
     * Get the name of the classes implemented
     *
     * @return string[]
     */
    public function getImplementedClasses()
    {
        return $this->implementedClasses;
    }

    /**
     * @return string[]
     */
    public function getTraits()
    {
        return $this->traits;
    }

    /**
     * @return string[]
     */
    public function getTraitCustomization()
    {
        return $this->traitCustomization;
    }
}
