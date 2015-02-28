<?php namespace FileModifier\Code\Entities\Traits;

trait FinalTrait
{

    /**
     * @var bool
     */
    protected $final = false;

    /**
     * @return boolean
     */
    public function isFinal()
    {
        return $this->final;
    }

    /**
     * @param boolean $final
     *
     * @return $this
     */
    public function setFinal($final)
    {
        $this->final = (bool) $final;

        return $this;
    }
}
