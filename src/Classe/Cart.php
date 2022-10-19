<?php

namespace App\Classe;

use Symfony\Component\HttpFoundation\Session\Session;

class Cart
{
    private $session;

    /**
     * @param $session
     */
    public function __construct()
    {
        $this->session = new Session();
    }


    public function add(int $id)
    {
        $cart = $this->session->get('cart');

        if ((!empty($cart[$id])))
            $cart[$id]++;
        else
            $cart[$id] = 1;

        $this->session->set('cart', $cart);
    }

    public function get()
    {
        return $this->session->get('cart');
    }

    public function remove()
    {
        $this->session->remove('cart');
    }
}