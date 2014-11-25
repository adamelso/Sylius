<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ArchetypeBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Product prototype form type.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class ArchetypeType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'sylius.form.archetype.name'
            ))
            ->add('parent', 'sylius_product_parent_choice', array(
                'required' => false,
                'label' => 'sylius.form.archetype.parent' // @todo add translations
            ))
            /** @todo  */
            ->add('attributes', 'sylius_product_attribute_choice', array(
                'required' => false,
                'multiple' => true,
                'label'    => 'sylius.form.archetype.attributes' /** @todo add translation */
            ))
            /** @todo */
            ->add('options', 'sylius_product_option_choice', array(
                'required' => false,
                'multiple' => true,
                'label'    => 'sylius.form.archetype.options' /** @todo add translation */
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_archetype';
    }
}
