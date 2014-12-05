<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\AttributeBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Doctrine listener used to manipulate mappings.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class LoadMetadataSubscriber implements EventSubscriber
{
    /**
     * @var array
     */
    protected $subjects;

    /**
     * Constructor
     *
     * @param array $subjects
     */
    public function __construct(array $subjects)
    {
        $this->subjects = $subjects;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            'loadClassMetadata'
        );
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();

        foreach ($this->subjects as $subject => $class) {
            if ($class['attribute_value']['model'] !== $metadata->getName()) {
                continue;
            }

            $subjectMapping = array(
                'fieldName'     => 'subject',
                'targetEntity'  => $class['subject'],
                'inversedBy'    => 'attributes',
                'joinColumns'   => array(array(
                    'name'                 => $subject.'_id',
                    'referencedColumnName' => 'id',
                    'nullable'             => false,
                    'onDelete'             => 'CASCADE'
                ))
            );

            $this->mapManyToOne($metadata, $subjectMapping);

            $attributeMapping = array(
                'fieldName'     => 'attribute',
                'targetEntity'  => $class['attribute']['model'],
                'joinColumns'   => array(array(
                    'name'                 => 'attribute_id',
                    'referencedColumnName' => 'id',
                    'nullable'             => false,
                    'onDelete'             => 'CASCADE'
                ))
            );

            $this->mapManyToOne($metadata, $attributeMapping);
        }
    }

    /**
     * @param $metadata
     * @param $subjectMapping
     */
    private function mapManyToOne($metadata, $subjectMapping)
    {
        if ($metadata->hasAssociation($subjectMapping['fieldName'])) {
//            $this->overrideManyToOneAssociationMapping($metadata, $subjectMapping);
        } else {
            $metadata->mapManyToOne($subjectMapping);
        }
    }

    /**
     * @param ClassMetadataInfo|ClassMetadata $metadata
     * @param array                           $mapping
     */
    private function overrideManyToOneAssociationMapping(ClassMetadataInfo $metadata, array $mapping)
    {
        $currentAttributeAssociationMapping = $metadata->getAssociationMapping($mapping['fieldName']);

        // Accessing public property that has been documented as read-only.
        unset($metadata->associationMappings[$mapping['fieldName']]);

        $metadata->mapManyToOne($mapping);

        $metadata->associationMappings[$mapping['fieldName']] = array_merge($currentAttributeAssociationMapping, $metadata->getAssociationMapping($mapping['fieldName']));
    }
}
