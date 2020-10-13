<?php

namespace App\Controller;

use Paydunya\Checkout\CheckoutInvoice;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaiementController extends AbstractController
{
    /**
     * @Route("/status", name="status")
     */
    public function index()
    {
        $co = new CheckoutInvoice();
        if ($co->confirm()){
            dd("yes");
        }
        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
        ]);
    }
}
