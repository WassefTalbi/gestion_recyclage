<?php

namespace App\Controller;

use App\Entity\Don;
use App\Form\DonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PdfGeneratorService;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Swift_Message;
use Swift_Mailer;
use Swift_SmtpTransport;

#[Route('/don')]
class DonController extends AbstractController
{
    #[Route('/', name: 'app_don_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $dons = $entityManager
            ->getRepository(Don::class)
            ->findAll();

        return $this->render('don/index.html.twig', [
            'dons' => $dons,
        ]);
    }
    #[Route('/f', name: 'app_don_indexf', methods: ['GET'])]
    public function indexf(EntityManagerInterface $entityManager,Request  $request , PaginatorInterface $paginator ): Response
    {
        $donnees = $entityManager
            ->getRepository(Don::class)
            ->findAll();
            $dons = $paginator->paginate(
                $donnees, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                3 // Nombre de résultats par page
            );

        return $this->render('don/indexf.html.twig', [
            'dons' => $dons,
        ]);
    }

    #[Route('/new', name: 'app_don_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $don = new Don();
        $form = $this->createForm(DonType::class, $don);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($don);
            $entityManager->flush();
            

            return $this->redirectToRoute('app_don_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('don/new.html.twig', [
            'don' => $don,
            'form' => $form,
        ]);
    }

    #[Route('/newf', name: 'app_don_newf', methods: ['GET', 'POST'])]
    public function newf(Request $request, EntityManagerInterface $entityManager): Response
    {
        $don = new Don();
        $form = $this->createForm(DonType::class, $don);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername('recycle.tunisia')
            ->setPassword('ztntffukvpwraygm');
        
        $mailer = new Swift_Mailer($transport);
        
        $message = (new Swift_Message('Bon d achat '))
            ->setFrom(['recycle.tunisia@gmail.com' => 'Recycle tunisia'])
            ->setTo(["medini.manar@esprit.tn"])
            ->setBody("un nouveau don a ete ajoutees");
        
        $mailer->send($message);
            $entityManager->persist($don);
            $entityManager->flush();
            

            return $this->redirectToRoute('app_don_indexf', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('don/newf.html.twig', [
            'don' => $don,
            'form' => $form,
        ]);
    }
    #[Route('/{idDons}', name: 'app_don_show', methods: ['GET'])]
    public function show(Don $don): Response
    {
        return $this->render('don/show.html.twig', [
            'don' => $don,
        ]);
    }

    #[Route('/{idDons}/f', name: 'app_don_showf', methods: ['GET'])]
    public function showf(Don $don): Response
    {
        return $this->render('don/showf.html.twig', [
            'don' => $don,
        ]);
    }
    #[Route('/{idDons}/edit', name: 'app_don_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Don $don, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DonType::class, $don);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_don_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('don/edit.html.twig', [
            'don' => $don,
            'form' => $form,
        ]);
    }

    #[Route('/{idDons}', name: 'app_don_delete', methods: ['POST'])]
    public function delete(Request $request, Don $don, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$don->getIdDons(), $request->request->get('_token'))) {
            $entityManager->remove($don);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_don_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/pdf/don', name: 'generator_service')]
    public function pdfService(): Response
    { 
        $don= $this->getDoctrine()
        ->getRepository(Don::class)
        ->findAll();

   

        $html =$this->renderView('pdf/index.html.twig', ['don' => $don]);
        $pdfGeneratorService=new PdfGeneratorService();
        $pdf = $pdfGeneratorService->generatePdf($html);

        return new Response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
        ]);
       
    }

}
