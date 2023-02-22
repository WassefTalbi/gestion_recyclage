<?php

namespace App\Test\Controller;

use App\Entity\Ticket;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TicketControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private TicketRepository $repository;
    private string $path = '/ticket/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Ticket::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ticket index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'ticket[Prix]' => 'Testing',
            'ticket[Quantite]' => 'Testing',
            'ticket[Type]' => 'Testing',
            'ticket[CreatedAt]' => 'Testing',
            'ticket[Evenement]' => 'Testing',
        ]);

        self::assertResponseRedirects('/ticket/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Ticket();
        $fixture->setPrix('My Title');
        $fixture->setQuantite('My Title');
        $fixture->setType('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setEvenement('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ticket');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Ticket();
        $fixture->setPrix('My Title');
        $fixture->setQuantite('My Title');
        $fixture->setType('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setEvenement('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'ticket[Prix]' => 'Something New',
            'ticket[Quantite]' => 'Something New',
            'ticket[Type]' => 'Something New',
            'ticket[CreatedAt]' => 'Something New',
            'ticket[Evenement]' => 'Something New',
        ]);

        self::assertResponseRedirects('/ticket/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getQuantite());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getEvenement());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Ticket();
        $fixture->setPrix('My Title');
        $fixture->setQuantite('My Title');
        $fixture->setType('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setEvenement('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/ticket/');
    }
}
