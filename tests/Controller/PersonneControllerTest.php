<?php

namespace App\Tests\Controller;

use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PersonneControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/personnes');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Liste des personnes');
        self::assertSelectorExists('table');
    }

    public function testShow(): void
    {
        $client = static::createClient();

        // On récupère une personne existante pour tester la page de détail
        $personneRepository = static::getContainer()->get(PersonneRepository::class);
        $personne = $personneRepository->findOneBy([]);

        // Si aucune personne n'existe, on ne peut pas tester la page show
        if (!$personne) {
            $this->markTestSkipped('Aucune personne trouvée en base de données.');
        }

        $client->request('GET', '/personnes/' . $personne->getId());

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Détails de la personne');
        self::assertSelectorTextContains('tbody tr:nth-child(2) td', $personne->getNom());
    }
}
