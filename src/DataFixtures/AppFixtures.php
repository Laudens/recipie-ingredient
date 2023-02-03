<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ingredient;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $ingredient = new Ingredient();
        for ($i = 1; $i <= 100; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($faker->word())
                ->setCreatAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-6 months')))
                ->setPrice(mt_rand(0, 200));
            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
