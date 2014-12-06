<?php

namespace Sylius\Bundle\ArchetypeBundle\Form\Type;

/**
 * Archetype choice form type.
 *
 * @author Adam Elsodaney <adam.elso@gmail.com>
 */
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
