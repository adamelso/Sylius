<?php

namespace Sylius\Component\Archetype\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Attribute\Model\AttributeInterface as BaseAttributeInterface;
use Sylius\Component\Variation\Model\OptionInterface as BaseOptionInterface;


class Archetype implements ArchetypeInterface
{
    /**
     * Id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Collection|AttributeInterface[]
     */
    protected $attributes;

    /**
     * @var Collection|OptionInterface[]
     */
    private $options;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
        $this->options = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * {@inheritDoc}
     */
    public function setAttributes(Collection $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * {@inheritDoc}
     */
    public function addAttribute(BaseAttributeInterface $attribute)
    {
        $this->attributes->add($attribute);
    }

    /**
     * {@inheritDoc}
     */
    public function removeAttribute(BaseAttributeInterface $attribute)
    {
        $this->attributes->removeElement($attribute);
    }

    /**
     * {@inheritDoc}
     */
    public function hasAttribute(BaseAttributeInterface $attribute)
    {
        return $this->attributes->contains($attribute);
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritDoc}
     */
    public function setOptions(Collection $options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function addOption(BaseOptionInterface $option)
    {
        $this->options->add($option);
    }

    /**
     * {@inheritDoc}
     */
    public function removeOption(BaseOptionInterface $option)
    {
        $this->options->removeElement($option);
    }

    /**
     * {@inheritDoc}
     */
    public function hasOption(BaseOptionInterface $option)
    {
        return $this->options->contains($option);
    }
}
