<?php

namespace App\Form;

use App\Entity\Gbs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GbsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('weight')
            ->add('note')
            ->add('company')
            ->add('goldclass')
            ->add('position')
            ->add('addtype')
            ->add('addreason')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gbs::class,
        ]);
    }
}
