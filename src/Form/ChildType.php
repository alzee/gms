<?php

namespace App\Form;

use App\Entity\Child;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ChildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('main')
            ->add('countPiece', IntegerType::class,  ['label' => 'child.countPiece'])
            ->add('goldclass')
            ->add('weight')
            ->add('note')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Child::class,
        ]);
    }
}
