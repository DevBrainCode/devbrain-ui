<?php

namespace Devbrain\Ui\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

// #[AsTwigComponent]
#[AsTwigComponent(template: '@DevbrainUi/Segment/index.html.twig')]
final class Segment
{
    public string $type;


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

        return $resolver->resolve($data) + $data;
    }

    #[PostMount]
    public function postMount(): void
    {
    }
}