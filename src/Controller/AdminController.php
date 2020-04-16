<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/admin/dashbord", name="dashbord")
     */
    public function dash()
    {
        return $this->render('admin/dash.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/docs", name="addDoc")
     */
    public function addDoc(Request $req)
    {

        $doc=new Document();
         //creation formulaire 
         $form=$this->createForm(DocumentType::class,$doc);
         //recuperation des donnees modifies
         $form->handleRequest($req);
         if($form->isSubmitted() && $form->isValid()){
             $em=$this->getDoctrine()->getManager();
             //Modification des donnees dans le db
             $em->persist($doc);
             $em->flush();
             //Ajout msg alert de success
             $this->addFlash("success","Ajouter avec success");

             //Redirection
             return $this->redirectToRoute('dashbord');
 
         }
     
         return $this->render('admin/index.html.twig', [
             'form' => $form->createView(),
 
         ]);
     }



}
