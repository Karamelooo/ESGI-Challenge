<?php

namespace App\Form;

use App\Entity\Invoices;
use App\Entity\Client;
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
            ->add('invoices_number')
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'company',
            ])
            ->add('company')
            ->add('due_date')
            ->add('orders', CollectionType::class, [
                'entry_type' => OrderType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__name__',
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
