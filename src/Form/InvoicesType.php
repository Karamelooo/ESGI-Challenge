<?php

namespace App\Form;

use App\Entity\Invoices;
use App\Entity\Client;
use App\Form\OrderType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'company',
                'attr' => [
                    'class' => 'mt-1 block w-full shadow-sm sm:text-sm border-lime-300 rounded-md'
                ],
                'label_attr' => [
                    'class' => 'block text-sm font-medium text-lime-500'
                ],
            ])
            ->add('due_date', null, [
                'attr' => [
                    'class' => 'mt-1 block w-full shadow-sm sm:text-sm border-lime-300 rounded-md'
                ],
                'label_attr' => [
                    'class' => 'block text-sm font-medium text-lime-500'
                ],
            ])
            ->add('orders', CollectionType::class, [
                'entry_type' => OrderType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__name__',
                'attr' => [
                    'class' => 'mt-1 block w-full shadow-sm sm:text-sm border-lime-300 rounded-md'
                ],
                'label_attr' => [
                    'class' => 'block text-sm font-medium text-lime-500'
                ],
            ])

            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoices::class,
        ]);
    }
}
