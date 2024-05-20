<?php
namespace Devbrain\UI\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Devbrain\UI\Twig\Runtime\ComponentRuntime;
use Devbrain\UI\Twig\Token\ComponentTokenParser;

class ComponentExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('component', [ComponentRuntime::class, 'render'], ['is_safe' => ['html']]),
            // new TwigFunction('add_attribute', [ComponentRuntime::class, 'addAttribute']),
            // new TwigFunction('get_attributes', [ComponentRuntime::class, 'getAttributes'], ['is_safe' => ['html']]),
        ];
    }

    public function getTokenParsers()
    {
        return [
            new ComponentTokenParser(),
        ];
    }
}
