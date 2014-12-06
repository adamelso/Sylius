<?php

namespace Sylius\Bundle\ProductBundle\Form\Type;

use Sylius\Bundle\ArchetypeBundle\Form\Type\ArchetypeChoiceType as BaseArchetypeChoiceType;

class ArchetypeChoiceType extends BaseArchetypeChoiceType
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
        return 'sylius_product_archetype_parent_choice';
    }
}
