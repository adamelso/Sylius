<?php

namespace Sylius\Bundle\ProductBundle\Form\Type;

class PrototypeEntityChoiceType extends PrototypeChoiceType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }
}
