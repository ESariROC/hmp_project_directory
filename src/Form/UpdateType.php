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

class UpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class, ['disabled' => true])
            ->add('type', TextType::class, ['disabled' => true])
            ->add('kleur', ChoiceType::class, ['choices' => [
                'Red' => 'red',
                'Blue' => 'blue',
                'Black' => 'black',
                'Wit' => 'wit'
            ]
            ])
            ->add('gewicht', IntegerType::class)
            ->add('prijs', IntegerType::class, [
                'invalid_message' => 'You entered an invalid value, it should be more than 10.000',
                'invalid_message_parameters' => ['%num%' => 10.000],
            ])
            ->add('voorraad', IntegerType::class, [
                'invalid_message' => 'You entered an invalid value, it should be minimum 1',
                'invalid_message_parameters' => ['%num%' => 1],
            ])
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
