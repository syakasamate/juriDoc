<?php

namespace App\DataFixtures;

use App\Entity\User;
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
        $manager->flush();
    }
}
