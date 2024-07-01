<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Tax;
use App\Entity\Services;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reducer')
            ->add('quantity')
            ->add('service', ServicesType::class)
            ->add('tax', EntityType::class, [
                'class' => Tax::class,
                'choice_label' => function ($tax) {
                    return $tax->getPercent();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
