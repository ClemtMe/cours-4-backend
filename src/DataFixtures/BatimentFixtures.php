<?php

namespace App\DataFixtures;

use App\Entity\Batiment as BatimentEntity;
use App\Repository\BatimentRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BatimentFixtures extends Fixture
{
    public const BATIMENT_REFERENCE = 'batiment_';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $types = ['Maison', 'Appartement', 'Immeuble', 'Villa'];

        for ($i = 0; $i < 10; $i++) {
            $batiment = new BatimentEntity();
            $batiment->setAdresse($faker->address());
            $batiment->setType($faker->randomElement($types));

            $manager->persist($batiment);
        }

        $manager->flush();
    }
}
