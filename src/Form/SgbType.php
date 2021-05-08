<?php

namespace App\Form;

use App\Entity\Sgb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class SgbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company')
            ->add('goldclass')
            ->add('position')
            ->add('subtracttype')
            ->add('subtractreason')
            ->add('weight', NumberType::class, ['label' => 'actualWeight'])
            ->add('weightBooked')
            ->add('short', NumberType::class)
            ->add('note')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sgb::class,
        ]);
    }
}
