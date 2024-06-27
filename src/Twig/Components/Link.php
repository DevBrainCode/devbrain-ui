<?php

namespace Devbrain\Ui\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@DevbrainUi/Link/index.html.twig')]
final class Link
{
    #[ExposeInTemplate(name: 'class', getter: 'fetchClass')]
    public string $class;

    #[ExposeInTemplate(name: 'label')]
    public string $label;

    #[ExposeInTemplate(name: 'href')]
    public string $url;

    #[ExposeInTemplate(name: 'target')]
    public string $target;



    // public function mount(bool $param = false)
    // {
    //     $this->param = $param;
    // }


    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        // Custom Class Attribute
        $resolver->setDefaults(['class' => ""]);
        $resolver->setAllowedTypes('class', ['string']);

        // Label
        $resolver->setRequired('label');
        $resolver->setAllowedTypes('label', ['string']);

        // Url
        $resolver->setRequired('url');
        $resolver->setAllowedTypes('url', ['string']);

        // Target
        $resolver->setDefaults(['target' => "_self"]);
        $resolver->setAllowedTypes('target', ['string']);

        return $resolver->resolve($data) + $data;
    }

    #[PostMount]
    public function postMount(): void
    {
    }

    /**
     * Build the class attribute
     */
    public function fetchClass(): string
    {
        return $this->class;
    }
}