<?php namespace FileModifier\Code\Entities\Traits;

trait AbstractTrait
{

    /**
     * @var bool
     */
    protected $abstract = false;

    /**
     * @return bool
     */
    public function isAbstract()
    {
        return $this->abstract;
    }

    /**
     * @param boolean $abstract
     *
     * @return $this
     */
    public function setAbstract($abstract)
    {
        $this->abstract = (bool) $abstract;

        return $this;
    }
}
