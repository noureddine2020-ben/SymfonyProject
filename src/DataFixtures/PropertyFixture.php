<?php

namespace App\DataFixtures;

use App\Entity\Proprity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<15;$i++)
        {   $faker=Factory::create('th_TH');
            $property=new Proprity();
            $property
                     ->setTitle($faker->words($nb=3,$asText=true)) // pour générer des mots automatinquement
                     ->setDescription($faker->sentences($nb=3, $asText=true))
                     ->setName($faker->words($nb=3,$asText=true))
                     ->setPrice($faker->numberBetween(5,15))
                     ->setLocation($faker->words($nb=2,$asText=true))
                     ->setDateMiseCircul($faker->dateTime)
                     ->setMarque($faker->words($nb=3,$asText=true))
                     ->setPuissance($faker->numberBetween(1,4))
                     ->setTranmission($faker->numberBetween(2,6))
                     ->setCompteur($faker->numberBetween(1,7))
                     ->setSolde(false);

            $manager->persist($property);
        }

        $manager->flush();
    }
}
