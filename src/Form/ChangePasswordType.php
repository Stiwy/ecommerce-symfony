<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Mon prénom',
                'disabled' => true,
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Mon nom',
                'disabled' => true,
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Mon e-mail',
                'disabled' => true,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 60
                    ]),
                    new Email()
                ]
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Veuillez saisir votre mot de passe actuel',
                'mapped' => false,
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'max' => 30
                    ]),
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => "Les mots de passe doivent êtres identique !",
                'required' => true,
                'first_options'  => ['label' => 'Veuillez saisir votre nouveau mot de passe'],
                'second_options' => ['label' => 'Veuillez confirmer votre nouveau mot de passe'],
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'max' => 30
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Valider"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
