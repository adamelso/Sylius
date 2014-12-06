<?php

namespace Sylius\Component\Archetype\Model;

use Sylius\Component\Attribute\Model\AttributeSubjectInterface;
use Sylius\Component\Variation\Model\VariableInterface;

/**
 * The class that is the result of copies made from an archetype, should
 * implement this interface.
 *
 * @author Adam Elsodaney <adam.elso@gmail.com>
 */
interface ArchetypeSubjectInterface extends AttributeSubjectInterface, VariableInterface
{
}
