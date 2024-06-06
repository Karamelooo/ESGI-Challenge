<?php

namespace App\Form;

use App\Entity\FormuleReducer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FormuleReducerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_date', DateType::class, [
                'label' => 'Date de début',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La date de début est requise.']),
                ]
            ])
            ->add('end_date', DateType::class, [
                'label' => 'Date de fin',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La date de fin est requise.']),
                ]
            ])
            ->add('value', NumberType::class, [
                'label' => 'Valeur',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La valeur est requise.']),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormuleReducer::class,
        ]);
    }
}
