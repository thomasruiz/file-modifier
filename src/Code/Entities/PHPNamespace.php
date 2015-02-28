<?php namespace FileModifier\Code\Entities;

class PHPNamespace
{

    const NO_NAMESPACE     = 1;
    const GLOBAL_NAMESPACE = 2;

    /**
     * @var string|int
     */
    private $name;

    /**
     * @var array
     */
    private $entites = [];

    /**
     * Construct a new PHPNamespace object
     *
     * @param int|string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param PHPClass $class
     */
    public function addClass(PHPClass $class)
    {
        $this->entites[] = $class;
    }

    /**
     * @return string|int
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|int $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->entites);
    }
}
