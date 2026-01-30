<?php

namespace App\Tests\Controller;

use App\Repository\BatimentRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BatimentControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/batiments');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Liste des bâtiments');
        self::assertSelectorExists('table');
    }

    public function testShow(): void
    {
        $client = static::createClient();

        // On récupère un bâtiment existant pour tester la page de détail
        $batimentRepository = static::getContainer()->get(BatimentRepository::class);
        $batiment = $batimentRepository->findOneBy([]);

        // Si aucun bâtiment n'existe, on ne peut pas tester la page show
        if (!$batiment) {
            $this->markTestSkipped('Aucun bâtiment trouvé en base de données.');
        }

        $client->request('GET', '/batiments/' . $batiment->getId());

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Détails du bâtiment');
        self::assertSelectorTextContains('tbody>tr>td', $batiment->getAdresse());
    }
}
