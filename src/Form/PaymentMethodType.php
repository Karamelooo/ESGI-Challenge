<?php

namespace App\Form;

use App\Entity\Payment;
use App\Entity\PaymentMethod;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PaymentMethodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $payments = $options['payment'];

        $choices = [];
        foreach ($payments as $payment) {
            $choices[$payment->getAmount()] = $payment->getId();
        }
        $builder
            ->add('method', ChoiceType::class, [
                'label' => 'Méthode de paiement',
                'choices' => [
                    'Espèce (1000€ maximum)' => 'Espèce',
                    'Chèque' => 'Chèque',
                    'Virement' => 'Virement',
                    'Carte bancaire' => 'Carte bancaire',
                ],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('payment', EntityType::class, [
                'class' => Payment::class,
                'choice_label' => 'amount',
                'label' => 'Paiement concerné',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Le paiement concerné est requis']),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PaymentMethod::class,
            'payment' => [],
        ]);
    }
}
