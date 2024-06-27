<?php

namespace Devbrain\Ui\Twig\Components;

use Devbrain\Ui\Enum\Button as EnumButton;
use Devbrain\Ui\Enum\Effect;
use Devbrain\Ui\Enum\Pallet;
use Devbrain\Ui\Enum\Size;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: '@DevbrainUi/Button/index.html.twig')]
final class Button
{
    public string $is;
    public string $type;
    public string $size;
    public string $class;
    public string $label;
    public string $effect;
    public string $eventHandler;
    public bool $block;
    public bool $outline;
    public bool $disabled;
    

    // public string $relAttribute;

    // public function mount(string $type = 'button')
    // {
    //     $this->type = $type;
    // }


    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        // Type
        $resolver->setDefaults(['type' => EnumButton::BUTTON->value]);
        $resolver->setAllowedValues('type', EnumButton::toArray());

        // Is (color pallet)
        $resolver->setDefaults(['is' => Pallet::PRIMARY->value]);
        $resolver->setAllowedTypes('is', 'string');
        $resolver->setAllowedValues('is', Pallet::toArray());

        // Outline
        $resolver->setDefaults(['outline' => false]);
        $resolver->setAllowedTypes('outline', 'boolean');

        // Effect
        $resolver->setDefaults(['effect' => "none"]);
        $resolver->setAllowedTypes('effect', 'string');
        $resolver->setAllowedValues('effect', Effect::toArray());

        // Class
        $resolver->setDefaults(['class' => ""]);
        $resolver->setAllowedTypes('class', ['string']);

        // Message
        $resolver->setRequired('label');
        $resolver->setAllowedTypes('label', 'string');

        // Dismissible
        $resolver->setDefaults(['block' => false]);
        $resolver->setAllowedTypes('block', 'boolean');

        // Disabled
        $resolver->setDefaults(['disabled' => false]);
        $resolver->setAllowedTypes('disabled', 'boolean');

        // Size
        $resolver->setDefaults(['size' => Size::NORMAL->value]);
        $resolver->setAllowedTypes('size', 'string');
        $resolver->setAllowedValues('size', Size::toArray());

        // Event Handler
        $resolver->setDefaults(['eventHandler' => ""]);
        $resolver->setAllowedTypes('eventHandler', 'string');

        return $resolver->resolve($data) + $data;
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->setClass();
    }

    private function setClass()
    {
        // Base class
        $class = "button button-{$this->is}";

        // Outline style
        if ($this->outline) {
            $class .= "-outline";
        }

        // Block
        if ($this->block) {
            $class .= " button-block";
        }

        // Size
        if (in_array($this->size, Size::toArray()) && $this->size != Size::NORMAL->value)
        {
            $class .= " button-{$this->size}";
        }

        // Effect
        $effect = ($this->effect != null && $this->effect != Effect::NONE->value) ? $this->effect : null;
        if ($effect) {
            $class .= " effect effect-{$effect}";
        }

        // Custom class
        if (!empty($this->class)) {
            $class .= " {$this->class}";
        }

        $this->class = $class;
    }
}