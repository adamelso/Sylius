<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ProductBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\AbstractResourceExtension;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * Product catalog extension.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class SyliusProductExtension extends AbstractResourceExtension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $this->configure(
            $config,
            new Configuration(),
            $container,
            self::CONFIGURE_LOADER | self::CONFIGURE_DATABASE | self::CONFIGURE_PARAMETERS | self::CONFIGURE_VALIDATORS
        );
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));

        $this->prependAttribute($container, $config);
        $this->prependVariation($container, $config);

        $this->createPrototypeServices($container, $config['driver']);
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    private function prependAttribute(ContainerBuilder $container, array $config)
    {
        if (!$container->hasExtension('sylius_attribute')) {
            return;
        }

        $container->prependExtensionConfig('sylius_attribute', array(
            'classes' => array(
                'product' => array(
                    'subject'         => $config['classes']['product']['model'],
                    'attribute'       => array(
                        'model' => 'Sylius\Component\Product\Model\Attribute'
                    ),
                    'attribute_value' => array(
                        'model' => 'Sylius\Component\Product\Model\AttributeValue'
                    ),
                )
            ))
        );
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    private function prependVariation(ContainerBuilder $container, array $config)
    {
        if (!$container->hasExtension('sylius_variation')) {
            return;
        }

        $container->prependExtensionConfig('sylius_variation', array(
            'classes' => array(
                'product' => array(
                    'variable'     => $config['classes']['product']['model'],
                    'variant'      => array(
                        'model'      => 'Sylius\Component\Product\Model\Variant',
                        'controller' => 'Sylius\Bundle\ProductBundle\Controller\VariantController',
                        'form'       => 'Sylius\Bundle\ProductBundle\Form\Type\VariantType'
                    ),
                    'option'       => array(
                        'model' => 'Sylius\Component\Product\Model\Option'
                    ),
                    'option_value' => array(
                        'model' => 'Sylius\Component\Product\Model\OptionValue'
                    ),
                )
            ))
        );
    }

    /**
     * Create services for product prototypes.
     *
     * @param ContainerBuilder $container
     * @param string           $driver
     */
    private function createPrototypeServices(ContainerBuilder $container, $driver)
    {
        $choiceTypeClasses = array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM => 'Sylius\Bundle\ProductBundle\Form\Type\PrototypeEntityChoiceType'
        );

        $alias = 'sylius_product_prototype_parent_choice';

        $prototypeChoiceFormType = new Definition($choiceTypeClasses[$driver]);
        $prototypeChoiceFormType
            ->setArguments(array('Sylius\Component\Product\Model\Product'))
            ->addTag('form.type', array('alias' => $alias))
        ;

        $container->setDefinition('sylius.form.type.'.$alias, $prototypeChoiceFormType);
    }
}
