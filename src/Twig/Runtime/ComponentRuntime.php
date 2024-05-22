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
     * @param string $part
     * @param array|null $options
     * @return void
     */
    public function getComponent(string $component, string $part='', ?array $options=[]): string
    {
        $base      = '@DevbrainUi';
        $directory = '';
        $file      = '';
        $version   = '';
        $partial   = '';
        $extension = '.html.twig';
        $component = explode(".", $component);


        // Base
        // --

        if (!preg_match("/\/$/", $base))
        {
            $base.= "/";
        }


        // Directory
        // --

        $directory = $component[0];

        if (!preg_match("/\/$/", $directory))
        {
            $directory.= "/";
        }


        // Version 
        // --

        $version   = $component[1] ?? 'v1';


        // File 
        // --

        $file = $component[0];

        if (!empty($version))
        {
            $file.= ".{$version}";
        }

        
        // Part
        // --

        if (!empty($part))
        {
            $partial = "partials/{$part}";
        }

        
        // Template
        // --

        if (empty($partial))
        {
            $template = "{$base}{$directory}{$file}{$extension}";
        }
        else 
        {
            $template = "{$base}{$directory}{$partial}{$extension}";
        }

        
        // Rendering
        // --

        return $this->environment->render($template, $options);
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