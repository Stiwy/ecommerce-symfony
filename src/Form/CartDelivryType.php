<?php

namespace App\Form;

use App\Entity\DelivryAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CartDelivryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('transport')
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ]
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Votre numéros de téléphone',
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'max' => 12
                    ])
                ]
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom de votre établissement',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Votre adresse',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ]
            ])
            ->add('zipCode', NumberType::class, [
                'label' => 'Votre code postal',
                'constraints' => [
                    new Length([
                        'min' => 4,
                        'max' => 5
                    ])
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Votre Ville',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Votre Pays',
                'data' => 'FR',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ]
            ])
            ->add('invoiceAddress', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Adresse de facturation identique',
                'required' => 'false',
                'data' => true
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Ajouter un message au transporteur',
                'required' => 'false',
                'constraints' => [
                    new Length([
                        'max' => 255
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DelivryAddress::class,
        ]);
    }
}
