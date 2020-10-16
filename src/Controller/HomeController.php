<?php
namespace App\Controller;

use DateTime;
use App\Repository\DocumentRepository;
use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
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
     //dd($categories);
        return $this->render('home/index.html.twig', [
            "categories"=> $categories,
            "date"=>date_format(new \DateTime(),"Y"),
            "home"=>true
        ]);
    }
     /**
     * @Route("renderpdf/{id}", name="render")
     */
    public function inx($id,DocumentRepository $repDoc,CategorieRepository $cat)
    {
        $user=$this->getUser();
        $jdate=new DateTime();
//s'il n'est pas connecté
if(!$user){
    $this->addFlash("success","Veillez vous connecter ou vous inscrire pour lire un document");
    return $this->redirectToRoute('login');
}else{
   if($user->getRole()!= "ROLE_ADMIN"){
    $subs=$user->getSubscriptions();
    if($subs  ){
        if($subs[count($subs)-1]){
           $sub= $subs[count($subs)-1];
           $datefin=$sub->getDateFin();
            if($datefin >= $jdate){
                $doc=$repDoc->find($id);
                $cats=$doc->getCategorie()->getLibelle();
                $catspack=$sub->getPack()->getCategories();
                foreach($catspack as $catspack){
                    if($catspack->getLibelle()==$cats){
                        $i=true;
                    }
                }
                if(!empty($i) && $i==true){
                    $categories=$cat->findAll();
                    $doc=$repDoc->find($id);
                    $pdfblob=stream_get_contents($doc->getFichier());
                    $pdf = base64_encode(($pdfblob));
                    $doc->setFichier($pdf);
                   return $this->render('home/pdf.html.twig', [
                      "doc"=>$doc,
                      "categories"=> $categories ]);
                }else{
                    $this->addFlash("success","Votre abonnement ne vous permet pas de consulter ce document ");
                    $this->addFlash("success","Veillez vous souscrire dans un autre packs! ");

                return $this->redirectToRoute('tarif');
                }
            }
            else{
                $this->addFlash("success","Veillez vous souscrire dans un de nos packs votre abonnement a expiré");
                return $this->redirectToRoute('tarif');
            }
        }
    }
        $this->addFlash("success","Veillez vous souscrire dans un de nos packs");
    return $this->redirectToRoute('tarif');
   }else{
    $categories=$cat->findAll();
    $doc=$repDoc->find($id);
    $pdfblob=stream_get_contents($doc->getFichier());
    $pdf = base64_encode(($pdfblob));
    $doc->setFichier($pdf);
   return $this->render('home/pdf.html.twig', [
      "doc"=>$doc,
      "categories"=> $categories ]);
   }
    
    
}
//sinon
       
    }
     /**
     * @Route("recherche", name="recherche")
     */
    public function search(Request $request,DocumentRepository $doc,CategorieRepository $ca,SousCategorieRepository $sca){
        
        if ($request->request->count()>0) {
            $search= $request->request->get('search');
            if(empty($search)){
                return;
            }

            $cat= $request->request->get('categorie');
            $datepub= $request->request->get('datepub');
            if(strstr($cat,'-')){
                
                $ex=explode('-',$cat);
               
                $categorie=$ca->find($ex[0]);
                $souscategorie=$ca->find($ex[1]);
                if(!empty($datepub)){
                    $docs = $doc->searchDoc($search,$cat,$souscategorie,$datepub);
                }else{
                    $docs = $doc->searchDoc($search,$cat,$souscategorie);
                }
                
            }else{
                $categorie=$ca->find($cat);
                $docs = $doc->searchDoc($search,$cat);
                if(!empty($datepub)){
                    $docs = $doc->searchDoc($search,$cat,null,$datepub);
                }else{
                    $docs = $doc->searchDoc($search,$cat);
                }
            }
           
           
           $categories=$ca->findAll();
           $juridique=array();
           $foncier=array();
           $finance=array();
           $affaires=array();
           $comptable=array();
           $social=array();
           $fiscal=array();
           foreach($docs as $doc){
            if($doc->getCategorie()->getLibelle() =="Juridique"){
                $jur=$doc;
                $juridique=array_merge(array($jur),$juridique);
             

            }
            if($doc->getCategorie()->getLibelle() =="Affaires"){
                $jur=$doc;
                $affaires=array_merge(array($jur),$affaires);
             

            }
            if($doc->getCategorie()->getLibelle() =="Foncier"){
                $jur=$doc;
                $foncier=array_merge(array($jur),$foncier);
             

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
           $jur=array();
            for($i=0;$i<count($juridique);$i++){
               if(!empty($jur[$juridique[$i]->getSouscat()->getId()])){
                
                   array_push($jur[$juridique[$i]->getSouscat()->getId()],($juridique[$i]));
               }else{
                $jur[$juridique[$i]->getSouscat()->getId()] = array($juridique[$i]);
               }
            }
            $soc=array();
            for($i=0;$i<count($social);$i++){
               if(!empty($soc[$social[$i]->getSouscat()->getId()])){
                
                   array_push($soc[$social[$i]->getSouscat()->getId()],($social[$i]));
               }else{
                $soc[$social[$i]->getSouscat()->getId()] = array($social[$i]);
               }
            }
            $fis=array();
            for($i=0;$i<count($fiscal);$i++){
               if(!empty($fis[$fiscal[$i]->getSouscat()->getId()])){
                
                   array_push($fis[$fiscal[$i]->getSouscat()->getId()],($fiscal[$i]));
               }else{
                $fis[$fiscal[$i]->getSouscat()->getId()] = array($fiscal[$i]);
               }
            }
            $fon=array();
            for($i=0;$i<count($foncier);$i++){
               if(!empty($fon[$foncier[$i]->getSouscat()->getId()])){
                
                   array_push($fon[$foncier[$i]->getSouscat()->getId()],($foncier[$i]));
               }else{
                $fon[$foncier[$i]->getSouscat()->getId()] = array($foncier[$i]);
               }
            }
            $aff=array();
            for($i=0;$i<count($affaires);$i++){
               if(!empty($aff[$affaires[$i]->getSouscat()->getId()])){
                
                   array_push($aff[$affaires[$i]->getSouscat()->getId()],($affaires[$i]));
               }else{
                $aff[$affaires[$i]->getSouscat()->getId()] = array($affaires[$i]);
               }
            }
            
          
         

        }else{
            $juridique="";
            $datepub="";
            $finance="";
            $fiscal="";
            $social="";
            $categories=$ca->findAll();
            $search=" ";
            return $this->render('home/try.html.twig', [
                "mots"=>$search,
                "categories"=>$categories,
                "date"=>date_format(new \DateTime(),"Y"),
               "juri"=>$juridique,
               "finance"=>$finance,
               "foncier"=>$foncier,
               "fiscal"=>$fiscal,
               'datepub'=>$datepub,
               "social"=>$social,
                ]);
        }



        return $this->render('home/try.html.twig', [
            "mots"=>$search,
            'datepub'=>$datepub,
            "cat"=>$cat,
            "categorie"=>$categorie,
            "categories"=>$categories,
            "date"=>date_format(new \DateTime(),"Y"),
            "docs"=> $docs,
           "juri"=>$juridique,
           "finance"=>$finance,
           "fiscal"=>$fiscal,
           "foncier"=>$foncier,
           "affaires"=>$affaires,
           "social"=>$social,
           "res"=> $jur,
           "soc"=> $soc,
           "fis"=>$fis,
           "fon"=>$fon,
           "aff"=>$aff
            ]);
    }
}
