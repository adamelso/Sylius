<?php

namespace Sylius\Component\Archetype\Builder;

use Sylius\Component\Archetype\Model\ArchetypeSubjectInterface;
use Sylius\Component\Archetype\Model\ArchetypeInterface;
use Sylius\Component\Attribute\Model\AttributeSubjectInterface;

/**
 * @author Adam Elsodaney <adam.elso@gmail.com>
 */
interface ArchetypeBuilderInterface
{
    /**
     * Build the archetype of product.
     *
     * @param ArchetypeInterface  $archetype
     * @param ArchetypeSubjectInterface $subject
     */
    public function build(ArchetypeInterface $archetype, ArchetypeSubjectInterface $subject);
}
