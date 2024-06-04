<?php

namespace App\Form;

use App\Entity\Compagny;
use App\Entity\Subscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $entreprises = $options['entreprises'];

        $choices = [];
        foreach ($entreprises as $entreprise) {
            $choices[$entreprise->getName()] = $entreprise->getId();
        }

        $builder
            ->add('start_date', DateType::class, [
                'label' => 'Date de début',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La date de début est requise.']),
                ],
            ])
            ->add('end_date', DateType::class, [
                'label' => 'Date de fin',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La date de fin est requise.']),
                ]
            ])
            ->add('compagny_subcription', EntityType::class, [
                'class' => Compagny::class,
                'choice_label' => 'name',
                'label' => 'Entreprise correspondante',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La sélection de l\'entreprise est requise.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subscription::class,
            'entreprises' => [],
        ]);
    }
}
