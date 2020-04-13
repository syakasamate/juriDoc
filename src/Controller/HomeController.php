<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("", name="home")
     */
    public function index(CategorieRepository $cat)
    {
       // if($this->getUser()!=null){
     //       dd($this->getUser());
     //   }
     $categories=$cat->findAll();
        return $this->render('home/index.html.twig', [
            "categories"=> $categories
        ]);
    }
}
