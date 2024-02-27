<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@example.com');
        $user->setFirstname('Test');
        $user->setLastname('DUPONT');
        $user->setProfilPictureeUrl('image/logo.png');
        $user->setPhoneNumber('0102030405');
        $user->setAdress('242 Rue du faubourg St Antoine');
        $user->setZipCode('75012');
        $user->setCity('Paris');
        $user->setPassword('TEST');
        
        $manager->persist($user);

        $manager->flush();
    }
}
