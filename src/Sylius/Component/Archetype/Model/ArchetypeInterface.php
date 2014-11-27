<?php

namespace Sylius\Component\Archetype\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Attribute\Model\AttributeInterface as BaseAttributeInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Variation\Model\OptionInterface as BaseOptionInterface;

interface ArchetypeInterface extends TimestampableInterface
{
    /**
     * Get name, in most cases it will be displayed by user only in backend.
     * Can be something like 't-shirt' or 'tv'.
     *
     * @return string
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Returns all prototype attributes.
     *
     * @return Collection|BaseAttributeInterface[]
     */
    public function getAttributes();

    /**
     * Sets all prototype attributes.
     *
     * @param Collection|BaseAttributeInterface[] $attributes
     */
    public function setAttributes(Collection $attributes);

    /**
     * Adds attribute.
     *
     * @param BaseAttributeInterface $attribute
     */
    public function addAttribute(BaseAttributeInterface $attribute);

    /**
     * Removes attribute from prototype.
     *
     * @param BaseAttributeInterface $attribute
     */
    public function removeAttribute(BaseAttributeInterface $attribute);

    /**
     * Checks whether prototype has given attribute.
     *
     * @param BaseAttributeInterface $attribute
     *
     * @return Boolean
     */
    public function hasAttribute(BaseAttributeInterface $attribute);

    /**
     * Returns all prototype options.
     *
     * @return Collection|BaseOptionInterface[]
     */
    public function getOptions();

    /**
     * Sets all prototype options.
     *
     * @param Collection|BaseOptionInterface[] $options
     */
    public function setOptions(Collection $options);

    /**
     * Adds option.
     *
     * @param BaseOptionInterface $option
     */
    public function addOption(BaseOptionInterface $option);

    /**
     * Removes option from prototype.
     *
     * @param BaseOptionInterface $option
     */
    public function removeOption(BaseOptionInterface $option);

    /**
     * Checks whether prototype has given option.
     *
     * @param BaseOptionInterface $option
     *
     * @return boolean
     */
    public function hasOption(BaseOptionInterface $option);

    /**
     * @return boolean
     */
    public function hasParent();

    /**
     * @param null|ArchetypeInterface $parent
     */
    public function setParent(ArchetypeInterface $parent = null);

    /**
     * @return null|ArchetypeInterface
     */
    public function getParent();

    /**
     * Get child archetypes.
     *
     * @return Collection|ArchetypeInterface[]
     */
    public function getChildren();

    /**
     * Has child archetype?
     *
     * @param ArchetypeInterface $archetype
     *
     * @return boolean
     */
    public function hasChild(ArchetypeInterface $archetype);

    /**
     * Add child archetype.
     *
     * @param ArchetypeInterface $archetype
     */
    public function addChild(ArchetypeInterface $archetype);

    /**
     * Remove child archetype.
     *
     * @param ArchetypeInterface $archetype
     */
    public function removeChild(ArchetypeInterface $archetype);

    public function getLeft();
    public function setLeft($left);
    public function getRight();
    public function setRight($right);
    public function getLevel();
    public function setLevel($level);
}
