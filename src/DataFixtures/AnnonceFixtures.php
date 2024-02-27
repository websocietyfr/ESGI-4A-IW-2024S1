<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Annonce;
use App\Entity\User;

class AnnonceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin1');
        $user->setEmail('admin1@example.com');
        $user->setFirstname('Test');
        $user->setLastname('DUPONT');
        $user->setProfilPictureeUrl('image/logo.png');
        $user->setPhoneNumber('0102030405');
        $user->setAdress('242 Rue du faubourg St Antoine');
        $user->setZipCode('75012');
        $user->setCity('Paris');
        $user->setPassword('TEST');

        $annonce = new Annonce();
        $annonce->setTitle('Ma première annonce');
        $annonce->setDescription('TEST');
        $annonce->setPrice(12.45);
        $annonce->setImage('image/logo.png');
        $annonce->setAuthor($user);
        
        $manager->persist($annonce);

        $manager->flush();
    }
}
