<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\Product\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Archetype\Model\Archetype;
use Sylius\Component\Archetype\Model\ArchetypeInterface;
use Sylius\Component\Attribute\Model\AttributeInterface as BaseAttributeInterface;
use Sylius\Component\Variation\Model\OptionInterface as BaseOptionInterface;

/**
 * Default prototype implementation.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class Prototype extends Archetype implements PrototypeInterface
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->subject = 'Sylius\Component\Product\Model\ProductInterface';
    }
}
