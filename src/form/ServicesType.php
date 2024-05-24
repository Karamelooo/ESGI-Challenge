<?php

namespace App\Form;

use App\Entity\Services;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
            ->add('purchase_price', IntegerType::class, [
                'label' => 'Prix d\'achat',
            ])
            ->add('selling_price', IntegerType::class, [
                'label' => 'Prix de vente',
            ])
            ->add('tax', IntegerType::class, [
                'label' => 'TVA',
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
