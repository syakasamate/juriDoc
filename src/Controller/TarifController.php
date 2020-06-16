<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class TarifController extends AbstractController
{
    
  
      /**
     * @Route("/tarif", name="tarif")
     */
    public function tarif(CategorieRepository $cat){
        $categories=$cat->findAll();
        return $this->render('Tarif/index.html.twig',[
            'Home' => true,
            "date"=>date_format(new \DateTime(),"Y"),
            "categories"=>$categories

        ]);

    }
}
