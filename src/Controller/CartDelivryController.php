<?php

namespace App\Controller;

use App\Entity\DelivryAddress;
use App\Form\CartDelivryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartDelivryController extends AbstractController
{
    #[Route('/mon-panier/livraison', name: 'app_cart_delivry')]
    public function index(): Response
    {
        $delivryAddress = new DelivryAddress();
        $form = $this->createForm(CartDelivryType::class, $delivryAddress);

        return $this->renderForm('cart_delivry/index.html.twig', compact('form'));
    }
}
