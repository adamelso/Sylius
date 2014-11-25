<?php

namespace Sylius\Bundle\ProductBundle\Form\Type;

use Sylius\Bundle\ArchetypeBundle\Form\Type\ArchetypeChoiceType;

class PrototypeChoiceType extends ArchetypeChoiceType
{
    /**
     * @param string $className
     */
    public function __construct($className)
    {
        parent::__construct('product', $className);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_product_prototype_parent_choice';
    }
}
