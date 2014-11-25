<?php

namespace spec\Sylius\Bundle\ProductBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilder;

class PrototypeEntityChoiceTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Sylius\Component\Product\Model\Product');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ProductBundle\Form\Type\PrototypeEntityChoiceType');
    }

    function it_is_a_Sylius_product_prototype_form_choice_type()
    {
        $this->shouldHaveType('Sylius\Bundle\ProductBundle\Form\Type\PrototypeChoiceType');
    }

    function it_is_a_Sylius_archetype_form_choice_type()
    {
        $this->shouldHaveType('Sylius\Bundle\ArchetypeBundle\Form\Type\ArchetypeChoiceType');
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement('Symfony\Component\Form\FormTypeInterface');
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe('sylius_product_prototype_parent_choice');
    }

    function it_has_a_parent_type()
    {
        $this->getParent()->shouldReturn('entity');
    }

    function it_builds_form_with_proper_fields(FormBuilder $builder)
    {
        $builder
            ->add('name', 'text', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->add('parent', 'sylius_product_prototype_parent_choice', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->add('attributes', 'sylius_product_attribute_choice', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->add('options', 'sylius_product_option_choice', Argument::any())
            ->willReturn($builder)
        ;

        $this->buildForm($builder, array());
    }
}
