<?php

namespace App\Form;

use App\Entity\Compagny;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CompagnyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est requis.']),
                ],
            ])
            ->add('logo_path', FileType::class, [
                'label' => 'Logo',
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('zip_code', TextType::class, [
                'label' => 'Code postal',
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
            ])
            ->add('siret', TextType::class, [
                'label' => 'SIRET',
            ])
            ->add('naf', TextType::class, [
                'label' => 'Code NAF',
            ])
            ->add('website', TextType::class, [
                'label' => 'Site Web',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
            ])
            ->add('capital', TextType::class, [
                'label' => 'Capital',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compagny::class,
        ]);
    }
}
