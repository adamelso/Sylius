<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\Archetype\Model;

use Sylius\Component\Attribute\Model\AttributeValue as BaseAttributeValue;

/**
 * Product to attribute value relation.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class AttributeValue extends BaseAttributeValue implements AttributeValueInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDerivative()
    {
        return parent::getSubject();
    }

    /**
     * {@inheritdoc}
     */
    public function setDerivative(DerivativeInterface $derivative = null)
    {
        return parent::setSubject($derivative);
    }
}
