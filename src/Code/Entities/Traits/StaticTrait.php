<?php namespace FileModifier\Code\Entities\Traits;

trait StaticTrait
{

    /**
     * @var bool
     */
    protected $static = false;

    /**
     * @return boolean
     */
    public function isStatic()
    {
        return $this->static;
    }

    /**
     * @param boolean $static
     *
     * @return $this
     */
    public function setStatic($static)
    {
        $this->static = (bool) $static;

        return $this;
    }
}
