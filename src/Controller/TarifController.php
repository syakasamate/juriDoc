<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class TarifController extends AbstractController
{
    
  
      /**
     * @Route("/tarif", name="tarif")
     */
    public function tarif(){

        return $this->render('Tarif/index.html.twig',[
            'Home' => true,
            "date"=>date_format(new \DateTime(),"Y")

        ]);

    }
}
