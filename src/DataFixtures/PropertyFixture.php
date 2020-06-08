<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyFixture extends Fixture
{//creer des biens dynamiquement(100 biens) sans intervention d'utilisateur
    public function load(ObjectManager $manager)
    
    {   $faker= Factory::create('fr_FR');
        for($i=0;$i<100;$i++)
        {
            $property=new Property();
            $property
                ->setTitle($faker->words(5, true))
                ->setDescription($faker->sentences(3, true))
                ->setSurface($faker->numberBetween(20, 350))
                ->setRooms($faker->numberBetween(2, 10))
                ->setBedrooms($faker->numberBetween(1, 9))
                ->setFloor($faker->numberBetween(0, 15))
                ->setPrice($faker->numberBetween(100000, 1000000))
                ->setHeat($faker->numberBetween(0, count(Property::HEAT)-1))
                ->setCity($faker->city)
                ->setAdress($faker->address)            
                ->setPostalCode($faker->postcode)
                ->setSolde(false);
                $manager->persist($property);


        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
