<?php

namespace Devbrain\Ui\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: '@DevbrainUi/Icon/index.html.twig')]
final class Icon
{
    public string $provider; // fa, remixicon, box icon
    public string $name;
    public string $type; // fill / stroke



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