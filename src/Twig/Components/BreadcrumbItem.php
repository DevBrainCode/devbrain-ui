<?php

namespace Devbrain\Ui\Twig\Components;

use Devbrain\Ui\Service\ClassListService;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@DevbrainUi/Breadcrumb/item.html.twig')]
final class BreadcrumbItem
{
    #[ExposeInTemplate(name: 'class', getter: 'fetchClass')]
    public string $class;

    #[ExposeInTemplate(name: 'label')]
    public string $label;

    #[ExposeInTemplate(name: 'url')]
    public string $url;

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