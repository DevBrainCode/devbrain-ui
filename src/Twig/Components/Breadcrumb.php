<?php

namespace Devbrain\Ui\Twig\Components;

use Devbrain\Ui\Service\ClassListService;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@DevbrainUi/Breadcrumb/breadcrumb.html.twig')]
final class Breadcrumb
{
    #[ExposeInTemplate(name: 'class', getter: 'fetchClass')]
    public string $class;

    #[ExposeInTemplate(name: 'items')]
    public array $items;


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

        // Items
        $resolver->setRequired('items');

        return $resolver->resolve($data) + $data;
    }


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    
    public function fetchClass(): string
    {
        $this->classlist->reset();
        $this->classlist->add("breadcrumb");
        $this->classlist->add($this->class);

        return $this->classlist->print();
    }
}