<?php namespace FileModifier\Code\Entities;

use FileModifier\Code\Entities\Partials\ClassMember;
use FileModifier\Code\Entities\Traits\AbstractTrait;
use FileModifier\Code\Entities\Traits\FinalTrait;

class PHPMethod extends ClassMember
{

    use AbstractTrait, FinalTrait;

    /**
     * @var string[]
     */
    private $parameters = [ ];

    /**
     * @var string
     */
    private $definition = null;

    /**
     * Add parameters to the method
     *
     * @param string|array $parameter,...
     *
     * @return $this
     */
    public function parameter($parameter)
    {
        $parameters       = is_array($parameter) ? $parameter : func_get_args();
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this;
    }

    /**
     * Set the definition of the method
     *
     * @param string $code
     *
     * @return $this
     */
    public function definition($code)
    {
        $this->definition = $code;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }
}
