<?php

namespace App\Controller;

use App\Classe\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(Cart $cart): Response
    {
        dd($cart->get());
        return $this->render('cart/index.html.twig');
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
}
