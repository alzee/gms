<?php

namespace App\Form;

use App\Entity\Main;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sn', TextType::class , ['required' => false])
            ->add('countPiece')
            ->add('countChild')
            ->add('perWeight')
            ->add('totalWeight')
            ->add('upstreamDoc')
            ->add('length')
            ->add('width')
            ->add('height')
            ->add('doctype')
            ->add('prodtype')
            ->add('goldclass')
            ->add('cotype')
            ->add('model')
            ->add('lossRate')
            ->add('factory')
            ->add('branch')
            ->add('note')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Main::class,
        ]);
    }
}
