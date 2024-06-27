<?php

namespace Devbrain\Ui\Twig\Components;

use Devbrain\Ui\Enum\Pallet;
use Devbrain\Ui\Service\ClassListService;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(template: '@DevbrainUi/Badge/badge.html.twig')]
final class Badge
{
    #[ExposeInTemplate(name: 'label', getter: 'fetchLabel')]
    public string $label;

    #[ExposeInTemplate(name: 'class', getter: 'fetchClass')]
    public string $class;

    public int $max;
    public string $is;
    public bool $outline;


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

        // Is (color pallet)
        $resolver->setDefaults(['is' => Pallet::PRIMARY->value]);
        $resolver->setAllowedTypes('is', 'string');
        $resolver->setAllowedValues('is', Pallet::toArray());

        // Max
        $resolver->setDefaults(['max' => 99]);
        $resolver->setAllowedTypes('max', 'numeric');

        // Custom Class Attribute
        $resolver->setDefaults(['class' => ""]);
        $resolver->setAllowedTypes('class', 'string');

        // Outline
        $resolver->setDefaults(['outline' => false]);
        $resolver->setAllowedTypes('outline', 'boolean');

        return $resolver->resolve($data) + $data;
    }


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function fetchLabel()
    {
        $label = $this->label;

        if (is_numeric($this->label) && $this->label > $this->max)
        {
            $label = "+{$this->max}";
        }

        return $label;
    }

    public function fetchClass(): string
    {
        $this->classlist->reset();
        $this->classlist->add("badge");
        // $this->classlist->add("badge-{$this->is}");

        $this->outline 
            ? $this->classlist->add("badge-{$this->is}-outline")
            : $this->classlist->add("badge-{$this->is}")
        ;

        $this->classlist->add($this->class);

        return $this->classlist->print();
    }
}