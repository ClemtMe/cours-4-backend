<?php

namespace App\DataFixtures;

use App\Entity\Batiment as BatimentEntity;
use App\Entity\Personne as PersonneEntity;
use App\Repository\BatimentRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonneFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private BatimentRepository $batimentRepository)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $batiments = $this->batimentRepository->findAll();

        for ($i = 0; $i < 10; $i++) {
            $personne = new PersonneEntity();
            $personne->setNom($faker->lastName());
            $personne->setPrenom($faker->firstName());
            $personne->setAge($faker->numberBetween(18, 90));

            $personne->setBatiment($batiments[$i]);

            $manager->persist($personne);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BatimentFixtures::class,
        ];
    }
}
