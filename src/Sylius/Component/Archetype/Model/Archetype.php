<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\Archetype\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Attribute\Model\AttributeInterface as BaseAttributeInterface;
use Sylius\Component\Variation\Model\OptionInterface as BaseOptionInterface;

/**
 * The archetype model.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 * @author Adam Elsodaney <adam.elso@gmail.com>
 */
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
     * @var string
     */
    protected $subject;

    /**
     * @var Collection|AttributeInterface[]
     */
    protected $attributes;

    /**
     * @var Collection|OptionInterface[]
     */
    protected $options;

    /**
     * Parent archetype.
     *
     * @var ArchetypeInterface
     */
    protected $parent;

    /**
     * Child archetypes.
     *
     * @var Collection|ArchetypeInterface[]
     */
    protected $children;

    /**
     * Required by DoctrineExtensions.
     *
     * @var mixed
     */
    protected $left;

    /**
     * Required by DoctrineExtensions.
     *
     * @var mixed
     */
    protected $right;

    /**
     * Required by DoctrineExtensions.
     *
     * @var mixed
     */
    protected $level;

    /**
     * Creation time.
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Last update time.
     *
     * @var \DateTime
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
        $this->options = new ArrayCollection();
        $this->createdAt = new \DateTime();
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

    /**
     * {@inheritDoc}
     */
    public function hasParent()
    {
        return null !== $this->parent;
    }

    /**
     * {@inheritDoc}
     */
    public function setParent(ArchetypeInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function hasChild(ArchetypeInterface $archetype)
    {
        return $this->children->contains($archetype);
    }

    /**
     * {@inheritdoc}
     */
    public function addChild(ArchetypeInterface $archetype)
    {
        if (!$this->hasChild($archetype)) {
            $archetype->setParent($this);

            $this->children->add($archetype);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeChild(ArchetypeInterface $archetype)
    {
        if ($this->hasChild($archetype)) {
            $archetype->setParent(null);

            $this->children->removeElement($archetype);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isRoot()
    {
        return null === $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * {@inheritdoc}
     */
    public function setLeft($left)
    {
        $this->left = $left;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * {@inheritdoc}
     */
    public function setRight($right)
    {
        $this->right = $right;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * {@inheritdoc}
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
