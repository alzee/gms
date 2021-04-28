<?php

namespace App\Form;

use App\Entity\Ca;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maindoc')
            ->add('artisan')
            ->add('weightGold')
            ->add('weightAttach')
            ->add('weight')
            ->add('craft')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ca::class,
        ]);
    }
}
