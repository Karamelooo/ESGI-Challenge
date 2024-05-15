<?php

namespace App\Form;

use App\Entity\Services;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est requis.']),
                ],
            ])
            ->add('category', TextType::class, [
                'label' => 'Famille',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'La famille est requise.']),
                ],
            ])
            ->add('selling_price', IntegerType::class, [
                'label' => 'Prix de vente',
                ],
            ])
            ->add('purchase_price', IntegerType::class, [
                'label' => 'Prix d\'achat',
                ],
            ])
            ->add('tax', IntegerType::class, [
                'label' => 'TVA',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Services::class,
        ]);
    }
}
