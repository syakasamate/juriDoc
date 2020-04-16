<?php

namespace App\Controller;

use App\Repository\DocumentRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
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
     /**
     * @Route("pdf", name="pdf")
     */
    public function inx()
    {
       // if($this->getUser()!=null){
     //       dd($this->getUser());
     //   }
     
        return $this->render('home/try.html.twig', [
           
        ]);
    }
     /**
     * @Route("recherche", name="recherche")
     */
    public function search(Request $request,DocumentRepository $doc,CategorieRepository $ca){
        
        if ($request->request->count()>0) {
            $search= $request->request->get('search');
            $cat= $request->request->get('categorie');
            $categorie=$ca->find($cat);
            dd($doc->searchDoc($search,$cat));

        }else{
            dd('ok');
        }
    }
}
