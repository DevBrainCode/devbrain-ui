<?php 
namespace Devbrain\UI\Twig\Node;

use Twig\Compiler;
use Twig\Node\Node;

class ComponentNode extends Node
{
    public function __construct($component, $version, $options, $lineno, $tag = null)
    {
        parent::__construct([
            'options' => $options
        ], [
            'component' => $component,
            'version'   => $version,
        ], $lineno, $tag);
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('echo $this->env->getRuntime(\'Devbrain\\UI\\Twig\\Runtime\\ComponentRuntime\')->render(')
            ->string($this->getAttribute('component'))
            ->raw(', ')
            ->string($this->getAttribute('version'))
            ->raw(', ')
            ->subcompile($this->getNode('options'))
            ->raw(");\n")
        ;

    }
}