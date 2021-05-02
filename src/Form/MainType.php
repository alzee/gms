<?php

namespace App\Form;

use App\Entity\Main;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('name')
            ->add('countChild')
            ->add('sn')
            ->add('perWeight')
            ->add('totalWeight')
            ->add('upstreamDoc')
            ->add('length')
            ->add('width')
            ->add('height')
            ->add('note')
            ->add('doctype')
            ->add('prodtype')
            ->add('goldclass')
            ->add('cotype')
            ->add('model')
            ->add('lossRate')
            ->add('factory')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Main::class,
        ]);
    }
}
