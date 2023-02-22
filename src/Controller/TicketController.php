<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\Evenement;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;
use App\Repository\EvenementRepository;

#[Route('/ticket')]
class TicketController extends AbstractController
{
    #[Route('/', name: 'app_ticket_index', methods: ['GET'])]
    public function index(TicketRepository $ticketRepository): Response
    {
        return $this->render('ticket/index.html.twig', [
            'tickets' => $ticketRepository->findAll(),
        ]);
    }

    #[Route('/{evenementid}/new', name: 'app_ticket_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Evenement $evenementid,TicketRepository $ticketRepository,EvenementRepository $evenementrepository): Response
    {
        $ticket = new Ticket();
       
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            $evenement = $evenementrepository->find($evenementid);
            $quantite = $ticket->getQuantite();
            $nbrPlace = $evenement->getnombrePlace();
            $nbrplacerestant = $nbrPlace - $quantite;
            $evenement->setnombrePlace($nbrplacerestant);
            $ticket->setEvenement($evenementid);
            $ticket->setPrix($evenement->getPrix());
            $ticket->setCreatedAt(new DateTimeImmutable('now'));
            if ( $ticket->getType()=="Enfant")
            {
               $m= $ticket->getPrix()-50;
                $ticket->setPrix($m);  
            }
            if ( $ticket->getType()=="Etudiant")
            {
               $m= $ticket->getPrix()-30;
                $ticket->setPrix($m);  
            }
            if ($nbrplacerestant < 0) {
                $this->addFlash('error', 'Désolé, les tickets pour cet événement sont épuisés.');
                return $this->redirectToRoute('app_evenement_indexx', ['/id' => $evenement->getId()]);
            }
            for ($i=0; $i<$quantite; $i++)
            { 

                $newTicket = clone $ticket;
                
                $ticketRepository->save($newTicket, true);
            }

            $id = $ticket->getId();
           dump($ticket);
            return $this->redirectToRoute('app_evenement_indexx', ['id' => $ticket->getId()]);

        }

        return $this->renderForm('client/ticket.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ticket_show', methods: ['GET'] , requirements: ['id' => '[^/]+'])]
    public function show(Ticket $ticket): Response
    {
        return $this->render('client/ticketdetail.html.twig', [
            'ticket' => $ticket,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ticket_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ticket $ticket, TicketRepository $ticketRepository): Response
    {
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticketRepository->save($ticket, true);

            return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ticket_delete', methods: ['POST'])]
    public function delete(Request $request, Ticket $ticket, TicketRepository $ticketRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticket->getId(), $request->request->get('_token'))) {
            $ticketRepository->remove($ticket, true);
        }

        return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
    }
}
