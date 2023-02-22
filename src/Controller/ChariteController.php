<?php

namespace App\Controller;

use App\Entity\Charite;
use App\Form\Charite1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/charite')]
class ChariteController extends AbstractController
{
    #[Route('/', name: 'app_charite_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $charites = $entityManager
            ->getRepository(Charite::class)
            ->findAll();

        return $this->render('charite/index.html.twig', [
            'charites' => $charites,
        ]);
    }
    #[Route('/f', name: 'app_charite_indexf', methods: ['GET'])]
    public function indexf(EntityManagerInterface $entityManager): Response
    {
        $charites = $entityManager
            ->getRepository(Charite::class)
            ->findAll();

        return $this->render('charite/indexf.html.twig', [
            'charites' => $charites,
        ]);
    }

    #[Route('/new', name: 'app_charite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $charite = new Charite();
        $form = $this->createForm(Charite1Type::class, $charite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($charite);
            $entityManager->flush();

            return $this->redirectToRoute('app_charite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('charite/new.html.twig', [
            'charite' => $charite,
            'form' => $form,
        ]);
    }
    

    #[Route('/{idCharite}', name: 'app_charite_show', methods: ['GET'])]
    public function show(Charite $charite): Response
    {
        return $this->render('charite/show.html.twig', [
            'charite' => $charite,
        ]);
    }

    #[Route('/{idCharite}/f', name: 'app_charite_showf', methods: ['GET'])]
    public function showf(Charite $charite): Response
    {
        return $this->render('charite/showf.html.twig', [
            'charite' => $charite,
        ]);
    }

    #[Route('/{idCharite}/edit', name: 'app_charite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Charite $charite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Charite1Type::class, $charite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_charite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('charite/edit.html.twig', [
            'charite' => $charite,
            'form' => $form,
        ]);
    }

    #[Route('/{idCharite}', name: 'app_charite_delete', methods: ['POST'])]
    public function delete(Request $request, Charite $charite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$charite->getIdCharite(), $request->request->get('_token'))) {
            $entityManager->remove($charite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_charite_index', [], Response::HTTP_SEE_OTHER);
    }
}
