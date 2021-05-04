<?php

namespace App\Form;

use App\Entity\Sgb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('weight')
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
