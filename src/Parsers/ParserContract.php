<?php namespace FileModifier\Parsers;

use FileModifier\File\File;
use PhpParser\Node;
use PhpParser\Node\Stmt\Namespace_;

interface ParserContract
{

    /**
     * @param Node[] $nodes
     * @param mixed  $target
     */
    public function parse(array $nodes, $target);

    /**
     * @param Namespace_ $node
     * @param File       $target
     */
    public function handleNamespace(Namespace_ $node, File $target);
}
