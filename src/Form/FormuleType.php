<?php

namespace App\Form;

use App\Entity\Formule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FormuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', NumberType::class,[
                'label' => 'Prix',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Le prix est requis.']),
                ],
            ])
            ->add('name', TextType::class,[
                'label' => 'Nom',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est requis.']),
                ]
            ])
            ->add('subscription', ChoiceType::class,[
                'label' => 'Abonnement',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'L\'abonnement est requis.']),
                ]
            ])
            ->add('formuleReducer', ChoiceType::class,[
                'label' => 'Formule de réduction',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La formule de réduction est requise.']),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formule::class,
        ]);
    }
}
