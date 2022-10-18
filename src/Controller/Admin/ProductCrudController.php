<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un produit')
            ->setEntityLabelInPlural('des produits')
            ->setPageTitle("index", "Tous les produits")
            ->setPageTitle("new", "Créer un produit")
            ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', '#')->hideOnForm(),
            TextField::new('name', 'Titre de l\'article'),
            TextField::new('subtitle', 'Sous-titreitre de l\'article'),
            SlugField::new('slug', 'Lien du produit')->setTargetFieldName('name'),
            ImageField::new('image', 'Image principal')
                ->setBasePath('uploads/images/products')
                ->setUploadDir('public/uploads/images/products')
                ->setUploadedFileNamePattern('[name]-[day]-[month]-[year].[extension]'),
            TextEditorField::new('description', 'Description'),
            MoneyField::new('price', 'Prix HT')->setNumDecimals(2)->setCurrency('EUR'),
            AssociationField::new('category', 'Catégorie produit')
        ];
    }
}
