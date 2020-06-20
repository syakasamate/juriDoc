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
        $categorie7=new Categorie();

        $categorie1->setLibelle('Juridique');
        $categorie2->setLibelle('Fiscal');
        $categorie3->setLibelle('Social');
        $categorie4->setLibelle('Foncier');
        $categorie5->setLibelle('Affaires');
        $categorie6->setLibelle('Normes Communautaires');
        $categorie7->setLibelle('Normes Internationales');

       
       

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
        $SousCategorie15=new SousCategorie();
        $SousCategorie16=new SousCategorie();
        $SousCategorie17=new SousCategorie();
        $SousCategorie18=new SousCategorie();
        $SousCategorie19=new SousCategorie();
        $SousCategorie20=new SousCategorie();
        $SousCategorie21=new SousCategorie();
    


        
        



        $SousCategorie1->setLibelle('Lois organique');
        $SousCategorie2->setLibelle('Lois référendaires');
        $SousCategorie3->setLibelle('Lois organiques');
        $SousCategorie4->setLibelle('Ordonnances');
        $SousCategorie5->setLibelle('Traités-Accords');
        $SousCategorie6->setLibelle('Conventions');
        $SousCategorie7->setLibelle('lois');
        $SousCategorie8->setLibelle('Decrets');
        $SousCategorie9->setLibelle('Arretés');
        $SousCategorie10->setLibelle('Circulaires');
        $SousCategorie11->setLibelle('Doctrines');
        $SousCategorie12->setLibelle(' National');
        $SousCategorie13->setLibelle('Communautaire');
        $SousCategorie14->setLibelle(' International');
        $SousCategorie15->setLibelle(' Assurances');
        $SousCategorie16->setLibelle('Banque');
        $SousCategorie17->setLibelle(' Investissement');
        $SousCategorie18->setLibelle(' Telecommunication');
        $SousCategorie19->setLibelle('CEDAO');
        $SousCategorie20->setLibelle('UEMOA');
        $SousCategorie21->setLibelle('Chartes');




        

        $categorie1->addSousCategorie($SousCategorie1)
                   ->addSousCategorie($SousCategorie2)
                   ->addSousCategorie($SousCategorie3)
                   ->addSousCategorie($SousCategorie4)
                   ->addSousCategorie($SousCategorie8)
                   ->addSousCategorie($SousCategorie9)
                   ->addSousCategorie($SousCategorie10);
    





        $categorie2->addSousCategorie($SousCategorie6)
                    ->addSousCategorie($SousCategorie7)
                    ->addSousCategorie($SousCategorie8)
                    ->addSousCategorie($SousCategorie9)
                    ->addSousCategorie($SousCategorie10)
                    ->addSousCategorie($SousCategorie11);

        $categorie3->addSousCategorie($SousCategorie6)
                    ->addSousCategorie($SousCategorie7)
                    ->addSousCategorie($SousCategorie8)
                    ->addSousCategorie($SousCategorie9);
                    
        $categorie4->addSousCategorie($SousCategorie7)
                    ->addSousCategorie($SousCategorie8)
                    ->addSousCategorie($SousCategorie9);

        $categorie5->addSousCategorie($SousCategorie15)
                    ->addSousCategorie($SousCategorie16)
                    ->addSousCategorie($SousCategorie17)
                    ->addSousCategorie($SousCategorie18);

                    
        $categorie6->addSousCategorie($SousCategorie19)
                    ->addSousCategorie($SousCategorie20);



        $categorie7->addSousCategorie($SousCategorie5)
                    ->addSousCategorie($SousCategorie6)
                    ->addSousCategorie($SousCategorie21);
                    
                    
                    
        
       
        $manager->persist($user);
        $manager->persist($categorie1);
        $manager->persist($categorie2);
        $manager->persist($categorie3);
        $manager->persist($categorie4);
        $manager->persist($categorie5);
        $manager->persist($categorie6);
        $manager->persist($categorie7);

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
        $manager->persist($SousCategorie15);
        $manager->persist($SousCategorie16);
        $manager->persist($SousCategorie17);
        $manager->persist($SousCategorie18);
        $manager->persist($SousCategorie19);
        $manager->persist($SousCategorie20);
        $manager->persist($SousCategorie21);
       




        $manager->flush();
    }
}
