<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ArchetypeBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\AbstractResourceExtension;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * Archetype extension.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class SyliusArchetypeExtension extends AbstractResourceExtension implements PrependExtensionInterface
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

        foreach ($config['classes'] as $archetypeName => $archetypeConfig) {
            $archetypeClassesDefinitionName = sprintf('sylius_attribute.classes.%s', $archetypeName);

            if ($container->hasDefinition($archetypeClassesDefinitionName)) {
                throw new \InvalidArgumentException(sprintf('Cannot create Sylius Attribute services for archetype `%s` as the definition `%s` already exists.', $archetypeName, $archetypeClassesDefinitionName));
            }

            $container->prependExtensionConfig('sylius_attribute', array(
                'classes' => array(
                    'archetype' => array(
                        'subject' => $archetypeConfig['subject'],
                        'attribute' => array(
                            'model' => 'Sylius\Component\Archetype\Model\Attribute'
                        ),
                        'attribute_value' => array(
                            'model' => 'Sylius\Component\Archetype\Model\AttributeValue'
                        ),
                    )
                )
            ));
        }
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

        foreach ($config['classes'] as $archetypeName => $archetypeConfig) {
            $archetypeClassesDefinitionName = sprintf('sylius_variation.classes.%s', $archetypeName);

            if ($container->hasDefinition($archetypeClassesDefinitionName)) {
                throw new \InvalidArgumentException(sprintf('Cannot create Sylius Variation services for archetype `%s` as the definition `%s` already exists.', $archetypeName, $archetypeClassesDefinitionName));
            }

            $container->prependExtensionConfig('sylius_variation', array(
                'classes' => array(
                    $archetypeName => array(
                        'variable' => $archetypeConfig['subject'],
                        'variant' => array(
                            'model'      => 'Sylius\Component\Archetype\Model\Variant',
                            //'controller' => 'Sylius\Bundle\ArchetypeBundle\Controller\VariantController',
                            //'form'       => 'Sylius\Bundle\VariationBundle\Form\Type\VariantType'
                        ),
                        'option' => array(
                            'model' => 'Sylius\Component\Archetype\Model\Option'
                        ),
                        'option_value' => array(
                            'model' => 'Sylius\Component\Archetype\Model\OptionValue'
                        ),
                    )
                )
            ));
        }
    }
}
