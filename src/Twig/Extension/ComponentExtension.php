<?php
namespace Devbrain\Ui\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Devbrain\Ui\Twig\Runtime\ComponentRuntime;
use Devbrain\Ui\Twig\Token\ComponentTokenParser;

class ComponentExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('component', [ComponentRuntime::class, 'getComponent'], ['is_safe' => ['html']]),
            
            new TwigFunction('_add_attribute', [ComponentRuntime::class, 'addAttribute']),
            new TwigFunction('_get_attributes', [ComponentRuntime::class, 'getAttributes'], ['is_safe' => ['html']]),
            new TwigFunction('_to_array', [ComponentRuntime::class, 'to_array']),
        ];
    }

    public function getTokenParsers()
    {
        return [
            new ComponentTokenParser(),
        ];
    }
}
