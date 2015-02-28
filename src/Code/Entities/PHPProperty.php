<?php

namespace FileModifier\Code\Entities;

use FileModifier\Code\Entities\Partials\ClassMember;

class PHPProperty extends ClassMember
{

    const DEFAULT_VALUE = 'PHP_PROPERTY_NOT_SET__';

    /**
     * @var mixed
     */
    protected $defaultValue = self::DEFAULT_VALUE;

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param mixed $defaultValue
     *
     * @return $this
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }
}
