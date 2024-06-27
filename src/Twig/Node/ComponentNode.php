<?php 
namespace Devbrain\Ui\Twig\Node;

use Twig\Compiler;
use Twig\Node\Node;

class ComponentNode extends Node
{
    public function __construct($component, $part, $options, $lineno, $tag = null)
    {
        parent::__construct([
            'options' => $options
        ], [
            'db_component' => $component,
            'part'   => $part,
        ], $lineno, $tag);
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('echo $this->env->getRuntime(\'Devbrain\\Ui\\Twig\\Runtime\\ComponentRuntime\')->getComponent(')
            ->string($this->getAttribute('db_component'))
            ->raw(', ')
            ->string($this->getAttribute('part'))
            ->raw(', ')
            ->subcompile($this->getNode('options'))
            ->raw(");\n")
        ;

    }
}