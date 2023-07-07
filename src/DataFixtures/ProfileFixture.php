<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $profile = new Profile();
        $profile->setReseauSocial('FaceBook');
        $profile->setUrl('https://www.facebook.com');

        $profile1 = new Profile();
        $profile1->setReseauSocial('Twitter');
        $profile1->setUrl('https://www.twitter.com');

        $profile2 = new Profile();
        $profile2->setReseauSocial('Google');
        $profile2->setUrl('https://www.google.com');

        $profile3 = new Profile();
        $profile3->setReseauSocial('Linkedin');
        $profile3->setUrl('https://www.linkedin.com/abdelfetah.hamra');

        $manager->persist($profile);
        $manager->persist($profile1);
        $manager->persist($profile2);
        $manager->persist($profile3);
        $manager->flush();
    }
}
