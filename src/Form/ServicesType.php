<?php

namespace App\Form;

use App\Entity\Services;
use App\Entity\Category;
use App\Entity\Tax;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Famille',
                'required' => true,
            ])
            ->add('purchase_price', IntegerType::class, [
                'label' => 'Prix d\'achat',
            ])
            ->add('selling_price', IntegerType::class, [
                'label' => 'Prix de vente',
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
