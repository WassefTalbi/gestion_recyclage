<?php

namespace App\Controller;

use App\Entity\Signalisation;
use App\Form\SignalisationType;
use App\Repository\AdresseRepository;
use App\Repository\SignalisationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/signalisation')]
class SignalisationController extends AbstractController
{
    //method permet to show all signaliation to the client frontoffice
    #[Route('/', name: 'app_signalisation_index', methods: ['GET'])]
    public function index(SignalisationRepository $signalisationRepository): Response
    {
        return $this->render('client/base.html.twig', [
            'signalisations' => $signalisationRepository->findAll(),
        ]);
    }
    //method permet to show all signaliation to the admin backoffice
    #[Route('/all', name: 'app_signalisation_allSignalisation', methods: ['GET'])]
    public function getAll(SignalisationRepository $signalisationRepository): Response
    {
        return $this->render('signalisation/allSignalisation.html.twig', [
            'signalisations' => $signalisationRepository->findAll(),
        ]);
    }
    
    //method permet to create new signalisation
    #[Route('/new', name: 'app_signalisation_new', methods: ['GET', 'POST'])]
    public function new(Request $request,  SignalisationRepository $signalisationRepository): Response
    {
        $signalisation = new Signalisation();
        $form = $this->createForm(SignalisationType::class, $signalisation);
        //      dd($form);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $uploadFile = $form['urlphoto']->getData();
            $filename = md5(uniqid()) . '.' . $uploadFile->guessExtension(); //cryptage d image
            $uploadFile->move($this->getParameter('kernel.project_dir') . '/public/uploads/signal_image', $filename);
            $signalisation->setUrlphoto($filename);
            $signalisation->setDateSignal(new DateTime());
            $signalisation->setTraited(false);
            $signalisationRepository->save($signalisation, true);
            return $this->redirectToRoute('app_signalisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('signalisation/new.html.twig', [
            'signalisation' => $signalisation,
            'form' => $form,
        ]);
    }
    //method permet to show signalisation by id
    #[Route('/{id}', name: 'app_signalisation_show', methods: ['GET'])]
    public function show(Signalisation $signalisation): Response
    {
        return $this->render('signalisation/show.html.twig', [
            'signalisation' => $signalisation,
        ]);
    }


    //method permet to update signalisation by id
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
    //method permet to delete signalisation by id
    #[Route('/{id}', name: 'app_signalisation_delete', methods: ['POST'])]
    public function delete(Request $request, Signalisation $signalisation, SignalisationRepository $signalisationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $signalisation->getId(), $request->request->get('_token'))) {
            $signalisationRepository->remove($signalisation, true);
        }

        return $this->redirectToRoute('app_signalisation_index', [], Response::HTTP_SEE_OTHER);
    }
}
