<?php

namespace App\Form;

use App\Entity\Gd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maindoc')
            ->add('team')
            ->add('artisan')
            ->add('goldclass')
            ->add('position')
            ->add('weight')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gd::class,
        ]);
    }
}
