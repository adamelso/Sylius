<?php

namespace Sylius\Bundle\ArchetypeBundle\Form\Type;

/**
 * Archetype choice form type.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
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
