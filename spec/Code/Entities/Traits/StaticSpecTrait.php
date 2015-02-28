<?php namespace spec\FileModifier\Code\Entities\Traits;

use FileModifier\Code\Entities\Traits\StaticTrait;

/**
 * Class StaticSpecTrait
 *
 * @package spec\FileModifier\Code\Entities\Traits
 * @mixin StaticTrait
 */
trait StaticSpecTrait
{
    function it_can_be_static()
    {
        $this->isStatic()->shouldBe(false);
        $this->setStatic(true)->shouldReturn($this);
        $this->isStatic()->shouldBe(true);
    }
}
