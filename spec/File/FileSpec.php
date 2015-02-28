<?php namespace spec\FileModifier\File;

use FileModifier\Code\Entities\PHPNamespace;
use FileModifier\File\File;
use PhpSpec\ObjectBehavior;

/**
 * Class FileSpec
 *
 * @package spec\FileModifier\File
 * @mixin File
 */
class FileSpec extends ObjectBehavior
{
    function let(PHPNamespace $namespace)
    {
        $namespace->getName()->willReturn(PHPNamespace::NO_NAMESPACE);
        $this->beConstructedWith($namespace);
    }
    
    /**
     * Has namespaces
     */
    function it_has_namespaces(PHPNamespace $namespace, PHPNamespace $namespaceAdded)
    {
        $this->getNamespaces()->shouldBe([ $namespace ]);

        $namespace->getName()->willReturn(PHPNamespace::NO_NAMESPACE);
        $namespace->isEmpty()->willReturn(true);
        $this->addNamespace($namespace);
        $this->getNamespaces()->shouldBe([ $namespace ]);

        $namespace->isEmpty()->willReturn(false);
        $namespace->setName(PHPNamespace::GLOBAL_NAMESPACE)->shouldBeCalled();
        $this->addNamespace($namespaceAdded);
        $this->getNamespaces()->shouldBe([ $namespace, $namespaceAdded ]);
    }

    /**
     * Has a current namespace
     */
    function it_has_a_current_namespace(PHPNamespace $namespace)
    {
        $this->getCurrentNamespace()->shouldBe($namespace);
    }
}
