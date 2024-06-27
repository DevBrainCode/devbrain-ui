<?php

namespace Devbrain\Ui\Twig\Components;

use Devbrain\Ui\Enum\Pallet;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

// #[AsTwigComponent]
#[AsTwigComponent(template: '@DevbrainUi/Alert/index.html.twig')]
final class Alert
{
    public string $type;
    public string $class;
    public string $message;
    public bool $dismissible;



    // public function mount(bool $dismissible = false)
    // {
    //     $this->dismissible = $dismissible;


    //     // Class attribute
    //     // $this->class = "alert alert- {$this->class}";
    //     $this->class = "";
    // }


    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        // Type
        $resolver->setDefaults(['type' => Pallet::SUCCESS->value]);
        $resolver->setAllowedTypes('type', 'string');
        $resolver->setAllowedValues('type', Pallet::toArray());

        // Class
        $resolver->setDefaults(['class' => ""]);
        $resolver->setAllowedTypes('class', ['string']);

        // Dismissible
        $resolver->setDefaults(['dismissible' => false]);
        $resolver->setAllowedTypes('dismissible', 'boolean');

        // Message
        $resolver->setRequired('message');
        $resolver->setAllowedTypes('message', 'string');

        return $resolver->resolve($data) + $data;
    }

    #[PostMount]
    public function postMount(): void
    {
        $class = "alert alert-{$this->type}";

        if (!empty($this->class)) {
            $class .= " {$this->class}";
        }

        $this->class = $class;
    }
}