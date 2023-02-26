<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Ticket;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/evenement')]
class EvenementController extends AbstractController 
{
    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }
    #[Route('/recherche', name: 'app_evenement_recherche', methods: ['GET'])]
    public function recherche(EvenementRepository $evenementRepository,Request $req ): Response
    { $nom=$req->get('nom') ;
        return $this->render('admin/index.html.twig', [
            'evenements' => $evenementRepository->recherche($nom),
        ]);
    }
    #[Route('/trie', name: 'trie', methods: ['GET'])]
    public function trie(EvenementRepository $evenementRepository,Request $req ): Response
    { 
        return $this->render('admin/index.html.twig', [
            'evenements' => $evenementRepository->TriparDate(),
        ]);
    }
    
    #[Route('/front', name: 'app_evenement_indexx', methods: ['GET'])]
    public function indexFront(EvenementRepository $evenementRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EvenementRepository $evenementRepository): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            // Handle file upload
            $file = $evenement->getImageFile();
            if ($file) {
               
                $newFileName =uniqid().'.'.$file->guessExtension();
               
                $file->move(
                    $this->getParameter('images_directory'),
                    $newFileName
                );

                $evenement->setImageName($newFileName);
            }
            
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/add.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('admin/detail.html.twig', [
            'evenement' => $evenement,
        ]);
    }
    #[Route('/f/{id}', name: 'app_evenement_showx', methods: ['GET'])]
    public function showF(Evenement $evenement): Response
    {
        return $this->render('client/detail.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             
            $entityManager = $this->getDoctrine()->getManager();
            
            // Handle file upload
            $file = $evenement->getImageFile();
            if ($file) {
               
                $newFileName =uniqid().'.'.$file->guessExtension();
               
                $file->move(
                    $this->getParameter('images_directory'),
                    $newFileName
                );

                $evenement->setImageName($newFileName);
            }
            
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/update.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $evenementRepository->remove($evenement, true);
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/tickets', name: 'app_evenement_hazem', methods: ['GET'])]
    public function tickets(Evenement $evenement)
    {
        $tickets = $this->getDoctrine()->getRepository(Ticket::class)->findBy([
            'Evenement' => $evenement,
        ]);

        return $this->render('admin/tickets.html.twig', [
            'evenement' => $evenement,
            'tickets' => $tickets,
        ]);
    }
}
