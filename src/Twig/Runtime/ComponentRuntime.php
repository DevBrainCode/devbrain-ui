<?php
namespace Devbrain\Ui\Twig\Runtime;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Twig\Extension\RuntimeExtensionInterface;
use Devbrain\Ui\DependencyInjection\Configuration;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ComponentRuntime implements RuntimeExtensionInterface
{
    /**
     * Bundle configuration
     *
     * @var array
     */
    private array $configuration = [];

    /**
     * Current Request
     */
    private Request $request;

    public function __construct(
        #[Autowire(service: 'service_container')] private ContainerInterface $container,
        private Environment $environment,
        private RequestStack $requestStack,
        private ParameterBagInterface $params,
    ){
        $this->configuration = $container->getParameter(Configuration::NAME);
        $this->request = $requestStack->getCurrentRequest();
    }

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

    // COOKIE BOX
    // --

    public function isCookieBoxInit(): bool
    {
        $name = $this->getCookieConsentName();
        return (bool) $this->request->cookies->get($name);
    }

    public function getCookieConsentName(): string
    {
        return $this->configuration['cookie_box']['name'];
    }

    public function cookie_box__is_property_customizable(string $property): bool
    {
        return $this->configuration['cookie_box']['properties'][$property]['customizable'];
    }
    public function cookie_box__is_property_disabled(string $property): bool
    {
        return $this->configuration['cookie_box']['properties'][$property]['disabled'];
    }
    public function cookie_box__is_property_checked(string $property): bool
    {
        $name = $this->getCookieConsentName();
        $properties = $this->request->cookies->get($name);

        if ($properties === null)
        {
            return $this->configuration['cookie_box']['properties'][$property]['default'];
        }
        else {
            if ($this->cookie_box__is_property_disabled($property))
            {
                return $this->configuration['cookie_box']['properties'][$property]['default'];
            }
            else
            {
                $properties = explode(",", $properties);
                return in_array($property, $properties);
            }
        }
    }




    public function doc_preview(string $source="", array $options=[])
    {
        $template = $this->environment->render(
            "@DevbrainUiDoc/sources/{$source}",
            $options
        );
        echo "<div class=\"rendering_preview\">{$template}</div>";
    }

    public function doc_code(string $source="")
    {
        $source = __DIR__."/../../../documentation/sources/{$source}";

        if (file_exists($source))
        {
            $content = file_get_contents($source);
            $content = htmlspecialchars($content);
            // $content = nl2br($content);

            echo "<pre class=\"code_preview\">{$content}</pre>";
        }
    }

    public function rand_id(): string
    {
        return uniqid();
    }
}