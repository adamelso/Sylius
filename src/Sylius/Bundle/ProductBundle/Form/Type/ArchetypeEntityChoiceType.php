<?php

namespace Sylius\Bundle\ProductBundle\Form\Type;

class ArchetypeEntityChoiceType extends ArchetypeChoiceType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }
}
