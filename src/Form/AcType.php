<?php

namespace App\Form;

use App\Entity\Ac;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AcType extends AbstractType
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
            'data_class' => Ac::class,
        ]);
    }
}
