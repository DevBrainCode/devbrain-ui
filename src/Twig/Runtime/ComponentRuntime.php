<?php
namespace Devbrain\Ui\Twig\Runtime;

use Twig\Environment;
use Twig\Extension\RuntimeExtensionInterface;

class ComponentRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private Environment $environment
    ){}

    /**
     * Render a component template
     *
     * @param string $component
     * @param string $version
     * @param array|null $options
     * @return void
     */
    public function render(string $component, string $version='', ?array $options=[]): string
    {
        $file = empty($version) ? $component : "{$component}.{$version}";

        return $this->environment->render(
            "@DevbrainUi/{$component}/{$file}.html.twig",
            $options
        );
    }


    
    public function addAttribute(array $attributes=[], ?string $name=null, mixed $value=null)
    {
        $attributes[$name] = $value;
        return $attributes;
    }

    /**
     * Render HTML Tags Attributes
     *
     * @param [type] $custom
     * @param array $base
     * @return string
     */
    public function getAttributes($custom, array $base = []): string 
    {
        $str = "";

        $attr = $custom + $base;

        foreach ($custom as $key => $value) {
            if (array_key_exists($key, $base)) {
                $attr[$key] = $base[$key] . ' ' . $value;
            }
        }

        foreach ($attr as $key => $value)
        {
            $value = trim($value);

            if (!empty($value))
            {
                if (!empty($str)) {
                    $str.= " ";
                }

                $str.= "$key=\"$value\"";
            }
        }

        return $str;
    }

    public function to_array(string|array $input): array
    {
        $output = $input;

        if (is_string($output))
        {
            $output = [$output];
        }

        return $output;
    }
}