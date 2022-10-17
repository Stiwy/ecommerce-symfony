<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    #[Route('/mon-compte/modifier-mon-mot-de-passe', name: 'app_account_password')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        $flash = null;
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->get('old_password')->getData())) {

                $password = $hasher->hashPassword($user, $form->get('new_password')->getData());
                $user->setPassword($password);

                $entityManager->flush();

                $flash = [
                    'type' => "success",
                    'message' => "Votre mot de passe à bien été mis à jour."
                ];
            } else {
                $flash = [
                    'type' => "danger",
                    'message' => "Votre mot de passe actuel est erroné."
                ];
            }
        }

        return $this->renderForm('account/password.html.twig', compact('form', 'flash'));
    }
}
