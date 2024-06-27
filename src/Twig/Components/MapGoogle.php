<?php

namespace Devbrain\Ui\Twig\Components;

use Devbrain\Ui\Service\ClassListService;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@DevbrainUi/Map/map-google.html.twig')]
final class MapGoogle
{
    #[ExposeInTemplate(name: 'href')]
    public string $href;

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

    public function fetchClass(): string
    {
        $this->classlist->reset();
        $this->classlist->add("map");
        $this->classlist->add("map-google");
        $this->classlist->add($this->class);

        return $this->classlist->print();
    }
}