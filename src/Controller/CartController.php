<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(Cart $cart, ProductRepository $productRepository): Response
    {
        $cartComplete = [];

        foreach ($cart->get() as $key => $value) {
            $cartComplete[] = [
                'product' => $productRepository->findOneBy(['id' => $key]),
                'quantity' => $value
            ];
        }

        return $this->render('cart/index.html.twig', compact('cartComplete'));
    }

    #[Route('/mon-panier/ajouter/{id}', name: 'app_cart_add', methods: 'GET')]
    public function add(Cart $cart, int $id): Response
    {
        $cart->add($id);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/mon-panier/supprimer', name: 'app_cart_remove', methods: 'GET')]
    public function remove(Cart $cart): Response
    {
        $cart->remove();

        return $this->redirectToRoute('app_product');
    }

    #[Route('/mon-panier/plus/{id}', name: 'app_cart_add_quantity', methods: 'GET')]
    public function addQuantity(Cart $cart, $id): Response
    {
        $cart->addQuantity($id);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/mon-panier/moins/{id}', name: 'app_cart_down_quantity', methods: 'GET')]
    public function downQuantity(Cart $cart, $id): Response
    {
        $cart->downQuantity($id);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/mon-panier/supprimer/{id}', name: 'app_cart_delete_product', methods: 'GET')]
    public function removeProduct(Cart $cart, $id): Response
    {
        $cart->removeProduct($id);

        return $this->redirectToRoute('app_cart');
    }
}
