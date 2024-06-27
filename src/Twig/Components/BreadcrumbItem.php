<?php

namespace Devbrain\Ui\Twig\Components;

use Devbrain\Ui\Service\ClassListService;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@DevbrainUi/Breadcrumb/breadcrumb-item.html.twig')]
final class BreadcrumbItem
{
    #[ExposeInTemplate(name: 'class', getter: 'fetchClass')]
    public string $class;

    // PreMount into the Link Component
    #[ExposeInTemplate(name: 'label')]
    public string $label;

    // PreMount into the Link Component
    #[ExposeInTemplate(name: 'url')]
    public string $url;

    // PreMount into the Link Component
    #[ExposeInTemplate(name: 'target')]
    public string $target;

    #[ExposeInTemplate(name: 'isActive')]
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

        // Custom Class Attribute
        $resolver->setDefaults(['class' => ""]);
        $resolver->setAllowedTypes('class', ['string']);

        // Is Active
        $resolver->setDefaults(['isActive' => false]);
        $resolver->setAllowedTypes('isActive', ['bool']);

        return $resolver->resolve($data) + $data;
    }


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    
    public function fetchClass(): string
    {
        $this->classlist->reset();
        $this->classlist->add("breadcrumb-item");

        if ($this->isActive)
        {
            $this->classlist->add("active");
        }

        return $this->classlist->print();
    }
}