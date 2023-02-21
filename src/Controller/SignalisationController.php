<?php

namespace App\Controller;

use App\Entity\Signalisation;
use App\Form\SignalisationType;
use App\Repository\SignalisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/signalisation')]
class SignalisationController extends AbstractController
{
    #[Route('/', name: 'app_signalisation_index', methods: ['GET'])]
    public function index(SignalisationRepository $signalisationRepository): Response
    {
        return $this->render('client/base.html.twig', [
            'signalisations' => $signalisationRepository->findAll(),
        ]);
    }
    #[Route('/all', name: 'app_signalisation_allSignalisation', methods: ['GET'])]
    public function getAll(): Response
    {
        return $this->render('signalisation/allSignalisation.html.twig');
    }

    #[Route('/new', name: 'app_signalisation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SignalisationRepository $signalisationRepository): Response
    {
        $signalisation = new Signalisation();
        $form = $this->createForm(SignalisationType::class, $signalisation);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $signalisationRepository->save($signalisation, true);

            return $this->redirectToRoute('app_signalisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('signalisation/new.html.twig', [
            'signalisation' => $signalisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_signalisation_show', methods: ['GET'])]
    public function show(Signalisation $signalisation): Response
    {
        return $this->render('signalisation/show.html.twig', [
            'signalisation' => $signalisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_signalisation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Signalisation $signalisation, SignalisationRepository $signalisationRepository): Response
    {
        $form = $this->createForm(SignalisationType::class, $signalisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $signalisationRepository->save($signalisation, true);

            return $this->redirectToRoute('app_signalisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('signalisation/edit.html.twig', [
            'signalisation' => $signalisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_signalisation_delete', methods: ['POST'])]
    public function delete(Request $request, Signalisation $signalisation, SignalisationRepository $signalisationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $signalisation->getId(), $request->request->get('_token'))) {
            $signalisationRepository->remove($signalisation, true);
        }

        return $this->redirectToRoute('app_signalisation_index', [], Response::HTTP_SEE_OTHER);
    }
}
