<?php

namespace Devbrain\Ui\Twig\Components;

use Devbrain\Ui\Service\ClassListService;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@DevbrainUi/Map/map.html.twig')]
final class Map
{
    #[ExposeInTemplate(name: 'href')]
    public string $href;

    #[ExposeInTemplate(name: 'provider', getter: 'fetchProvider')]
    public string $provider;

    #[ExposeInTemplate(name: 'dataset')]
    public array $dataset;

    #[ExposeInTemplate(name: 'class', getter: 'fetchClass')]
    public string $class;

    
    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function __construct( private ClassListService $classlist ){}

    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        // Href
        $resolver->setRequired('href');
        $resolver->setAllowedTypes('href', 'string');

        // Dataset
        $resolver->setDefaults(['dataset' => []]);
        $resolver->setAllowedTypes('dataset', 'array');

        // Custom Class Attribute
        $resolver->setDefaults(['class' => ""]);
        $resolver->setAllowedTypes('class', 'string');

        return $resolver->resolve($data) + $data;
    }


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function fetchProvider(): ?string
    {
        $host = parse_url($this->href, PHP_URL_HOST);

        if (preg_match("/google/", $host))
        {
            return 'google';
        }

        return null;
    }

    public function fetchClass(): string
    {
        $this->classlist->reset();
        $this->classlist->add("map");
        $this->classlist->add($this->class);

        return $this->classlist->print();
    }
}