<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ProductBundle\Form\Type;

use Sylius\Bundle\ArchetypeBundle\Form\Type\ArchetypeType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Product prototype form type.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class PrototypeType extends ArchetypeType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_product_prototype';
    }
}
