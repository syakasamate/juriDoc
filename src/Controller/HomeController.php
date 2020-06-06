<?php

namespace App\Controller;

use DateTime;
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
            "categories"=> $categories,
            "date"=>date_format(new \DateTime(),"Y")
        ]);
    }
     /**
     * @Route("renderpdf/{id}", name="render")
     */
    public function inx($id,DocumentRepository $repDoc)
    {
         $doc=$repDoc->find($id);
         $pdfblob=stream_get_contents($doc->getFichier());
         $pdf = base64_encode(($pdfblob));
         $doc->setFichier($pdf);
        return $this->render('home/pdf.html.twig', [
           "doc"=>$doc]);
    }
     /**
     * @Route("recherche", name="recherche")
     */
    public function search(Request $request,DocumentRepository $doc,CategorieRepository $ca){
        
        if ($request->request->count()>0) {
            $search= $request->request->get('search');
            if(empty($search)){
                return;
            }
            $cat= $request->request->get('categorie');
           $categorie=$ca->find($cat);
           $docs = $doc->searchDoc($search,$cat);
           $categories=$ca->findAll();
           $juridique=array();
           $finance=array();
           $comptable=array();
           $social=array();
           $fiscal=array();
           foreach($docs as $doc){
            if($doc->getCategorie()->getLibelle() =="Jurique"){
                $jur=$doc;
                $juridique=array_merge(array($jur),$juridique);
            }
            
            
            if($doc->getCategorie()->getLibelle() =="Financier"){
                $jur=$doc;
                $finance=array_merge(array($jur),$finance);
            }
            if($doc->getCategorie()->getLibelle() =="Fiscal"){
                $jur=$doc;
                $fiscal=array_merge(array($jur),$fiscal);
            }
            
            if($doc->getCategorie()->getLibelle() =="Comptable"){
                $jur=$doc;
                $comptable=array_merge(array($jur),$comptable);
            }
            if($doc->getCategorie()->getLibelle() =="Social"){
                $jur=$doc;
                $social=array_merge(array($jur),$social);
            }
            
            
           }
          
         

        }else{
            dd('ok');
        }



        return $this->render('home/try.html.twig', [
            "mots"=>$search,
            "categorie"=>$categorie,
            "categories"=>$categories,
            "date"=>date_format(new \DateTime(),"Y"),
            "docs"=> $docs,
           "juri"=>$juridique,
           "finance"=>$finance,
           "fiscal"=>$fiscal,
           "social"=>$social,
            ]);
    }
}
