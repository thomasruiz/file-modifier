<?php namespace spec\FileModifier\Code\Entities\Traits;

use FileModifier\Code\Entities\Traits\AbstractTrait;

/**
 * Class AbstractSpecTrait
 *
 * @package spec\FileModifier\Code\Entities\Traits
 * @mixin AbstractTrait
 */
trait AbstractSpecTrait
{


    function it_can_be_abstract()
    {
        $this->isAbstract()->shouldBe(false);
        $this->setAbstract(true)->shouldReturn($this);
        $this->isAbstract()->shouldBe(true);
    }
}
