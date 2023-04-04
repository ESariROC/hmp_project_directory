<?php

namespace App\Form;

use App\Entity\Autos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class)
            ->add('type', TextType::class)
            ->add('kleur', ChoiceType::class, ['choices' => [
                'Red' => 'red',
                'Blue' => 'blue',
                'Black' => 'black',
                'Wit' => 'wit'
                ]
            ])
            ->add('gewicht', IntegerType::class)
            ->add('prijs', IntegerType::class)
            ->add('voorraad', IntegerType::class)
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Autos::class,
        ]);
    }
}
