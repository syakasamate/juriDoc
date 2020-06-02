<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Categorie;
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
        $user->setUsername("ADMIN");
        $user->setEmail("admin@admin.com");
        $hsh=$this->encoder->encodePassword($user,"ADMINJURIDOC");
        $user->setPassword(($hsh));
        $manager->persist($user);
        $categorie1=new Categorie();
        $categorie2=new Categorie();
        $categorie3=new Categorie();
        $categorie4=new Categorie();
        $categorie5=new Categorie();
        $categorie2->setLibelle('Jurique');
        $categorie1->setLibelle('Fiscal');
        $categorie3->setLibelle('Social');
        $categorie4->setLibelle('Comptable');
        $categorie5->setLibelle('Financier');
        $manager->persist($user);
        $manager->persist($categorie1);
        $manager->persist($categorie2);
        $manager->persist($categorie3);
        $manager->persist($categorie4);
        $manager->persist($categorie5);
        $manager->flush();
    }
}
