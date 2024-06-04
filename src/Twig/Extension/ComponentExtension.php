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

            // Cookie Consent
            new TwigFunction('is_cookie_box_init', [ComponentRuntime::class, 'isCookieBoxInit']),
            new TwigFunction('_cookie_box__has_property', [ComponentRuntime::class, 'cookie_box__is_property_customizable']),
            new TwigFunction('_cookie_box__is_property_disabled', [ComponentRuntime::class, 'cookie_box__is_property_disabled']),
            new TwigFunction('_cookie_box__is_property_checked', [ComponentRuntime::class, 'cookie_box__is_property_checked']),
            new TwigFunction('_get_cookie_name', [ComponentRuntime::class, 'getCookieConsentName']),
        ];
    }

    public function getTokenParsers()
    {
        return [
            new ComponentTokenParser(),
        ];
    }
}
