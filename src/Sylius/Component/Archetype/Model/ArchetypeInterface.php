<?php

namespace Sylius\Component\Archetype\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Attribute\Model\AttributeInterface as BaseAttributeInterface;
use Sylius\Component\Variation\Model\OptionInterface as BaseOptionInterface;

interface ArchetypeInterface
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
     * @param ArchetypeInterface $parent
     */
    public function setParent(ArchetypeInterface $parent);

    /**
     * @return ArchetypeInterface
     */
    public function getParent();
}
