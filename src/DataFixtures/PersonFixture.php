<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

       for($i=0;$i<100;$i++)
       {
           $person = new Person();
           $person->setFirstname($faker->firstName);
           $person->setLastname($faker->lastName);
           $person->setAge($faker->numberBetween(18,75));
           $person->setSex($faker->boolean());

           $manager->persist($person);

       }

       $manager->flush();
    }
}
