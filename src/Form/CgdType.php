<?php

namespace App\Form;

use App\Entity\Cgd;
use App\Entity\Main;
use App\Entity\Child;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CgdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('main', EntityType::class , [
                'placeholder' => '选择主单',
                'class' => Main::class,
                'required' => false
            ])
            ->add('child', EntityType::class , [
                'placeholder' => '选择子单',
                'class' => Child::class,
                'required' => false
            ])
            ->add('goldclass')
            ->add('position')
            ->add('weight')
            ->add('note')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cgd::class,
        ]);
    }
}
