<?php

namespace Devbrain\Ui\Twig\Components;

use Devbrain\Ui\Service\ClassListService;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@DevbrainUi/Link/link.html.twig')]
final class Link
{
    #[ExposeInTemplate(name: 'label')]
    public string $label;

    #[ExposeInTemplate(name: 'href')]
    public string $url;

    #[ExposeInTemplate(name: 'target')]
    public string $target;

    #[ExposeInTemplate(name: 'isDisabled')]
    public string $disabled;

    #[ExposeInTemplate(name: 'dataset')]
    public array $dataset;

    #[ExposeInTemplate(name: 'class', getter: 'fetchClass')]
    public string $class;

    public bool $noClassLink;
    public bool $isActive;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function __construct( private ClassListService $classlist ){}

    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        // Label
        $resolver->setRequired('label');
        $resolver->setAllowedTypes('label', 'string');

        // Url
        $resolver->setRequired('url');
        $resolver->setAllowedTypes('url', 'string');

        // Target
        $resolver->setDefaults(['target' => "_self"]);
        $resolver->setAllowedTypes('target', 'string');

        // Is disabled
        $resolver->setDefaults(['disabled' => false]);
        $resolver->setAllowedTypes('disabled', 'bool');

        // Dataset
        $resolver->setDefaults(['dataset' => []]);
        $resolver->setAllowedTypes('dataset', 'array');

        // Custom Class Attribute
        $resolver->setDefaults(['class' => ""]);
        $resolver->setAllowedTypes('class', 'string');

        // No class Link
        $resolver->setDefaults(['noClassLink' => false]);
        $resolver->setAllowedTypes('noClassLink', 'bool');

        // Is Active
        $resolver->setDefaults(['isActive' => false]);
        $resolver->setAllowedTypes('isActive', 'bool');

        return $resolver->resolve($data) + $data;
    }


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function fetchClass(): string
    {
        $this->classlist->reset();

        if (!$this->noClassLink)
        {
            $this->classlist->add('link');
        }

        if ($this->isActive)
        {
            $this->classlist->add('active');
        }

        $this->classlist->add($this->class);

        return $this->classlist->print();
    }
}