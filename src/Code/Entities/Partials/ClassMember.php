<?php namespace FileModifier\Code\Entities\Partials;

use FileModifier\Code\Entities\Traits\StaticTrait;
use FileModifier\Code\Factory\CodeFactoryContract;
use InvalidArgumentException;

abstract class ClassMember
{

    use StaticTrait;

    const IS_PUBLIC    = 0x01;
    const IS_PRIVATE   = 0x02;
    const IS_PROTECTED = 0x04;
    const IS_STATIC    = 0x08;
    const IS_ABSTRACT  = 0x10;
    const IS_FINAL     = 0x20;

    /**
     * @var int
     */
    private $visibility = null;

    /**
     * @var string
     */
    private $name;

    /**
     * @var CodeFactoryContract
     */
    private $codeFactory;

    /**
     * Construct a new ClassMember object
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the visibility of the member
     *
     * @param int $visibility
     *
     * @return $this
     */
    public function setVisibility($visibility)
    {
        $this->validateUniqueVisibility($visibility &= ( self::IS_PUBLIC | self::IS_PRIVATE | self::IS_PROTECTED ));

        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param int $visibility
     */
    private function validateUniqueVisibility($visibility)
    {
        if ($visibility !== self::IS_PUBLIC && $visibility !== self::IS_PRIVATE && $visibility !== self::IS_PROTECTED &&
            $visibility !== 0
        ) {
            throw new InvalidArgumentException("A class member cannot have more than one visibility.");
        }
    }
}
