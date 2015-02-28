<?php namespace spec\FileModifier\Code\Entities\Traits;

use FileModifier\Code\Entities\Traits\FinalTrait;

/**
 * Class FinalSpecTrait
 *
 * @package spec\FileModifier\Code\Entities\Traits
 * @mixin FinalTrait
 */
trait FinalSpecTrait
{


    function it_can_be_final()
    {
        $this->isFinal()->shouldBe(false);
        $this->setFinal(true)->shouldReturn($this);
        $this->isFinal()->shouldBe(true);
    }
}
