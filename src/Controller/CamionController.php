<?php

namespace App\Controller;

use App\Entity\Camion;
use App\Form\CamionType;
use App\Repository\CamionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/camion')]
class CamionController extends AbstractController
{
    #[Route('/', name: 'app_camion_index', methods: ['GET'])]
    public function index(CamionRepository $camionRepository): Response
    {
        return $this->render('camion/index.html.twig', [
            'camions' => $camionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_camion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CamionRepository $camionRepository): Response
    {
        $camion = new Camion();
        $form = $this->createForm(CamionType::class, $camion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadFile = $form['urlphoto']->getData();
            $filename = md5(uniqid()) . '.' . $uploadFile->guessExtension(); //cryptage d image


            $uploadFile->move($this->getParameter('kernel.project_dir') . '/public/uploads/camion_image', $filename);
            $camion->setUrlphoto($filename);



            $camionRepository->save($camion, true);

            return $this->redirectToRoute('app_camion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('camion/new.html.twig', [
            'camion' => $camion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_camion_show', methods: ['GET'])]
    public function show(Camion $camion): Response
    {
        return $this->render('camion/show.html.twig', [
            'camion' => $camion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_camion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $camion = $em->getRepository(Camion::class)->find($id);
        $form = $this->createForm(CamionType::class, $camion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadFile = $form['urlphoto']->getData();
            $filename = md5(uniqid()) . '.' . $uploadFile->guessExtension(); //cryptage d image


            $uploadFile->move($this->getParameter('kernel.project_dir') . '/public/uploads/camion_image', $filename);
            $camion->setUrlphoto($filename);

            $em->flush();

            return $this->redirectToRoute('app_camion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('camion/edit.html.twig', [
            'camion' => $camion,
            'form' => $form,
        ]);
    }



    #[Route('/{id}', name: 'app_camion_delete', methods: ['POST'])]
    public function delete(Request $request, $id)
    {
        $camion = $this->getDoctrine()->getRepository(Camion::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($camion);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->redirectToRoute('app_camion_index');
    }
}
