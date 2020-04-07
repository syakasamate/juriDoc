<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login_form")
     */
    public function login(AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils->getLastAuthenticationError();
         
        return $this->render('security/login.html.twig',[
            'error' => $error,
            'login' => true,
            'title'=>'Connexion'
        ]);
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){

    }
      /**
     * @Route("/", name="acceuil")
     */
    public function acceuil(){

        return $this->render('Acceuil/Acceuil.html.twig',[
            'Home' => true
        ]);

    }
}