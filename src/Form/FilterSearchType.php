<?php

namespace App\Form;

use App\Classe\Search;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\SearchType;

class FilterSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('string', SearchType::class, [
                'label' => 'Rechercher',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Chercher...'
                ],
                'constraints' => [
                    new Length([
                        'max' => 30
                    ])
                ]
            ])
            ->add('categories', EntityType::class, [
                'label' => 'Catégorie produit',
                'required' => false,
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Filtrer",
                'attr' => [
                    'class' => 'btn btn-dark w-100'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
