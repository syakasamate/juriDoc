<?php

namespace App\Controller;

use Paydunya\Checkout\Store;
use Paydunya\Checkout\CheckoutInvoice;
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
     /**
     * @Route("/paiement/{id}", name="paiement")
     */
    public function paye($id){
       if($this->getUser()){
        $invoice = new CheckoutInvoice();
        $total_amount = 0;
        
        $invoice->addItem("PACK PLATINIUM",1,50000,50000);
        
        $invoice->setTotalAmount(50000);
        
        if($invoice->create()) {
            Store::setCallbackUrl("/status");
            return $this->redirect($invoice->getInvoiceUrl());
         
        }else{
           dd($invoice->response_text);
        }
       }else{
        $this->addFlash("success","Veillez vous inscrire avant de payer un pack");

           return $this->redirectToRoute('inscription');

       }
    }
}
