<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistreController extends AbstractController
{
    /**
     * @Route("/registre", name="inscription")
     */
    
    public function registration(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder )
    {
            $user = new User();

    $form = $this->createForm(UserType::class, $user );
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
         $hsh=$encoder->encodePassword($user,$user->getPassword());
         $user->setPassword(($hsh));
         $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
         $entityManager->flush();
         $this->addFlash("success","Inscription validée-vous pouvez vous-connectez");
         return $this->redirectToRoute('login');

    }
        return $this->render('registre/registre.html.twig', [
            'connection'=>true,
            'form'=>$form->createView(),
            'title'=>'Inscription'
        ]);
    }

    
}
