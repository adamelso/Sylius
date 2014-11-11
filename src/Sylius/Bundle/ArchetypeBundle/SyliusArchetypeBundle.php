<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ArchetypeBundle;

use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class SyliusArchetypeBundle extends AbstractResourceBundle
{
    /**
     * {@inheritdoc}
     */
    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getBundlePrefix()
    {
        return 'sylius_archetype';
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelInterfaces()
    {
        return array(
            'Sylius\Component\Archetype\Model\ArchetypeInterface'      => 'sylius.model.archetype.class',
            'Sylius\Component\Archetype\Model\AttributeInterface'      => 'sylius.model.archetype_attribute.class',
//            'Sylius\Component\Archetype\Model\AttributeValueInterface' => 'sylius.model.archetype_attribute_value.class',
//            'Sylius\Component\Archetype\Model\VariantInterface'        => 'sylius.model.archetype_variant.class',
//            'Sylius\Component\Archetype\Model\OptionInterface'         => 'sylius.model.archetype_option.class',
//            'Sylius\Component\Archetype\Model\OptionValueInterface'    => 'sylius.model.archetype_option_value.class',
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelNamespace()
    {
        return 'Sylius\Component\Archetype\Model';
    }
}
