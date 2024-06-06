<?php

namespace App\Form;

use App\Entity\Formule;
use App\Entity\FormuleReducer;
use App\Entity\Subscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

        $subscriptions = $options['subscriptions'];

        $choices = [];
        foreach ($subscriptions as $subscription) {
            $choices[$subscription->getName()] = $subscription->getId();
        }

        $formulesReductions = $options['formulesReductions'];

        $choices = [];
        foreach ($formulesReductions as $formuleReduction) {
            $choices[$formulesReductions->getName()] = $formuleReduction->getId();
        }

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
            ->add('subscription', EntityType::class, [
                'class' => Subscription::class,
                'choice_label' => 'compagny_subcription',
                'label' => 'Abonnement correspondant',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La sélection de l\'abonnement est requis.']),
                ],
            ])
            ->add('formuleReducer', EntityType::class, [
                'class' => FormuleReducer::class,
                'choice_label' => 'value',
                'label' => 'Formule de réduction',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La formule de réduction est requise..']),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formule::class,
            'subscriptions' => [],
            'formulesReductions' => [],
        ]);
    }
}
