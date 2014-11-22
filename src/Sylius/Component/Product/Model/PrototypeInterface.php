<?php

/*
 * This file is part of the Sylius package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\Product\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Archetype\Model\ArchetypeInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Attribute\Model\AttributeInterface as BaseAttributeInterface;
use Sylius\Component\Variation\Model\OptionInterface as BaseOptionInterface;

/**
 * Used to generate full product form.
 * It simplifies product creation.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
interface PrototypeInterface extends TimestampableInterface, ArchetypeInterface
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
     * @return Collection|AttributeInterface[]
     */
    public function getAttributes();

    /**
     * Sets all prototype attributes.
     *
     * @param Collection $attributes
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
     * @return Collection|OptionInterface[]
     */
    public function getOptions();

    /**
     * Sets all prototype options.
     *
     * @param Collection $options
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
     * @return Boolean
     */
    public function hasOption(BaseOptionInterface $option);
}
