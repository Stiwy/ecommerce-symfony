<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\FilterSearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/nos-produits', name: 'app_product')]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        $products = [];

        $search = new Search();
        $form = $this->createForm(FilterSearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $products = $productRepository->findBySearch($search);
        } else {
            $products = $productRepository->findAll();
        }

        return $this->renderForm('product/index.html.twig', compact('products', 'form'));
    }

    #[Route('/produit/{slug}', name: 'app_product_show')]
    public function show(Product $product, $slug): Response
    {
        return $this->render('product/show.html.twig', compact('product'));
    }
}
