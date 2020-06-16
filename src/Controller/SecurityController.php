<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */

     
    public function login(AuthenticationUtils $authenticationUtils,CategorieRepository $cat){
        $categories=$cat->findAll();
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('security/login.html.twig',[
            'error' => $error,
            'login' => true,
            'title'=>'Connexion',
            "date"=>date_format(new \DateTime(),"Y"),
            "categories"=>$categories

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
