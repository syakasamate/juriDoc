<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistreController extends AbstractController
{
    /**
     * @Route("/registre", name="inscription")
     */
    
    public function registration(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder )
    {

        if($request->request->count()>0){
            $user = new User();
            $hsh=$encoder->encodePassword($user,$request->request->get('password'));
          $user->setPassword($hsh)
              ->setCivilite($request->request->get('civilite'))
              ->setPrenom($request->request->get('prenom'))
              ->setUsername($request->request->get('username'))
             ->setTelephone($request->request->get('telephone'))
             ->setNomS($request->request->get('nom_S'))
             ->setAdresseS($request->request->get('Adresse_S'))
             ->setTelephoneS($request->request->get('telephone_S'))
             ->setNumeroIF($request->request->get('numero_I_F'))
             ->setEmail($request->request->get('email'))
             ->setCode($request->request->get('code'))
             ->setRole(("ROLE_USER"));

             $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($user);
         $entityManager->flush();
         $this->addFlash("success","Inscription validée-vous pouvez vous-connectez");
         return $this->redirectToRoute('login');

        }
        return $this->render('registre/registre.html.twig', [
            'connection'=>true,
           // 'form'=>$form->createView(),
            'title'=>'Inscription',
            "date"=>date_format(new \DateTime(),"Y")
        ]);
    }

    /**
     * @Route("/condition", name="condition")
     * 
     */
    public function condition(){
    return $this->render('Condition/index.html.twig', [
        "date"=>date_format(new \DateTime(),"Y")
        ]
        );
}
}
