<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture


{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user=new User();
        $user->setRole("ROLE_ADMIN");
        $user->setCivilite("Mr");
        $user->setNomS("nasrulex.com");
        $user->setTelephone("783884597");
        $user->setUsername("ADMIN");
        $user->setPrenom("Moussa");
        $user->setEmail("Admin@nasrulex.com");
        $hsh=$this->encoder->encodePassword($user,"ADMINNASRULEX");
        $user->setPassword(($hsh));
        $manager->persist($user);
        $categorie1=new Categorie();
        $categorie2=new Categorie();
        $categorie3=new Categorie();
        $categorie4=new Categorie();
        $categorie5=new Categorie();
        $categorie6=new Categorie();
        $categorie1->setLibelle('Juridique');
        $categorie2->setLibelle('Fiscal');
        $categorie3->setLibelle('Social');
        $categorie4->setLibelle('Foncier');
        $categorie5->setLibelle('Comptable');
        $categorie6->setLibelle('Affaires');
       

        $SousCategorie1=new SousCategorie();
        $SousCategorie2=new SousCategorie();
        $SousCategorie3=new SousCategorie();
        $SousCategorie4=new SousCategorie();
        $SousCategorie5=new SousCategorie();
        $SousCategorie6=new SousCategorie();
        $SousCategorie7=new SousCategorie();
        $SousCategorie8=new SousCategorie();
        $SousCategorie9=new SousCategorie();
        $SousCategorie10=new SousCategorie();
        $SousCategorie11=new SousCategorie();
        $SousCategorie12=new SousCategorie();
        $SousCategorie13=new SousCategorie();
        $SousCategorie14=new SousCategorie();


        $SousCategorie1->setLibelle('Conventions');
        $SousCategorie2->setLibelle('lois');
        $SousCategorie3->setLibelle('Decrets');
        $SousCategorie4->setLibelle('Arretés');
        $SousCategorie5->setLibelle('Circulaires');
        $SousCategorie6->setLibelle('Doctrines');
        $SousCategorie7->setLibelle('Ordonnances');
        $SousCategorie8->setLibelle(' National');
        $SousCategorie9->setLibelle('Communautaire');
        $SousCategorie10->setLibelle(' International');
        $SousCategorie11->setLibelle(' Assurances');
        $SousCategorie12->setLibelle('Banque');
        $SousCategorie13->setLibelle(' Investissement');
        $SousCategorie14->setLibelle(' Telecommunication');

        

        $categorie1->addSousCategorie($SousCategorie2);

        $categorie2->addSousCategorie($SousCategorie1)
                    ->addSousCategorie($SousCategorie2)
                    ->addSousCategorie($SousCategorie3)
                    ->addSousCategorie($SousCategorie4)
                    ->addSousCategorie($SousCategorie5)
                    ->addSousCategorie($SousCategorie6);

        $categorie3->addSousCategorie($SousCategorie1)
                    ->addSousCategorie($SousCategorie2)
                    ->addSousCategorie($SousCategorie3)
                    ->addSousCategorie($SousCategorie4);
                    
        $categorie4->addSousCategorie($SousCategorie2)
                    ->addSousCategorie($SousCategorie3)
                    ->addSousCategorie($SousCategorie4);

        $categorie5->addSousCategorie($SousCategorie8)
                    ->addSousCategorie($SousCategorie9)
                    ->addSousCategorie($SousCategorie10);
                    
        $categorie6->addSousCategorie($SousCategorie11)
                    ->addSousCategorie($SousCategorie12)
                    ->addSousCategorie($SousCategorie13)
                    ->addSousCategorie($SousCategorie14);
                    
                    
        
       
        $manager->persist($user);
        $manager->persist($categorie1);
        $manager->persist($categorie2);
        $manager->persist($categorie3);
        $manager->persist($categorie4);
        $manager->persist($categorie5);
        $manager->persist($categorie6);
        $manager->persist($SousCategorie1);
        $manager->persist($SousCategorie2);
        $manager->persist($SousCategorie3);
        $manager->persist($SousCategorie4);
        $manager->persist($SousCategorie5);
        $manager->persist($SousCategorie6);
        $manager->persist($SousCategorie7);
        $manager->persist($SousCategorie8);
        $manager->persist($SousCategorie9);
        $manager->persist($SousCategorie10);
        $manager->persist($SousCategorie11);
        $manager->persist($SousCategorie12);
        $manager->persist($SousCategorie13);
        $manager->persist($SousCategorie14);

        $manager->flush();
    }
}
