<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Controller\Fuction;
use App\Entity\Ticket;
use App\Entity\User;
use App\Form\TicketType;
use App\Form\EvenementType;
use App\Repository\TicketRepository;
use App\Repository\EvenementRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Swift_Message;
use Swift_Mailer;
use Swift_SmtpTransport;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator

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
   
    public function ticketGagnene(Evenement $evenement,EvenementRepository $er) : Void
    {
        $ee = $this->getDoctrine()->getRepository(Evenement::class);
        $events = $ee->findAll();
        $eventCollection = [];
        $ticketsCollection = [];
        foreach($events as $event)
        {
           if ($event->isEtat()==false)
           {
     if ($event->getNombrePlace() == 0 )
         {
            $eventCollection[]=$event;
            $event->setEtat(true);
         }
           }}
         for($i = 0; $i < count($eventCollection); $i++) {
           
            $event = $eventCollection[$i];
            $idEvent = $event->getId() ;
         $tickets = $this->getDoctrine()->getRepository(Ticket::class)->findBy([
            'Evenement' => $idEvent,
        ]);
        foreach($tickets as $ticketss)
        {
        $ticketsCollection[] = $ticketss;
        }
        $randomNumber = rand(1, count($ticketsCollection));
        for($j = 0; $j < count($ticketsCollection); $j++) {
            if($j == $randomNumber)
            {
             $ticketGagnate = $ticketsCollection[$randomNumber] ;
             $ticketGagnate->setStatus(true);
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($ticketGagnate);
            $entityManager->flush();
           // envoyer le ticket gagnante par mail
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername('recycle.tunisia')
            ->setPassword('ztntffukvpwraygm');
        
        $mailer = new Swift_Mailer($transport);
        
        $message = (new Swift_Message('Bon d achat '))
            ->setFrom(['recycle.tunisia@gmail.com' => 'Recycle tunisia'])
            ->setTo([$ticketGagnate->getTicket()->getEmail()])
            ->setBody(
                $this->renderView(
                    'ticket/bondachat.html.twig',
                    [
                        'id' => $ticketGagnate->getId(),
                        'user' =>$ticketGagnate->getTicket()->getName(),
                        'ticket' =>$ticketGagnate,
                    ]
                ),
                'text/html'
            );
        
        $mailer->send($message);
           


            }
           
        }
         
        
        
    }
       

      
    }
    #[Route('/front', name: 'app_evenement_indexx', methods: ['GET'])]
    public function indexFront(EvenementRepository $evenementRepository, PaginatorInterface $paginator,Request $request/*, $iduser*/,UserRepository $ur): Response
    {   $evenementt = New Evenement();
        // $user = $ur->find($iduser);
        // $userName = $user->getName();
        $donnees = $evenementtt=$evenementRepository->findAll();
       $etat = false;
       for ($i=1;$i<count($evenementtt);$i++)
       { 
        $etat =$evenementtt[$i]->isEtat();
        if(!$etat)
        {$this->ticketGagnene($evenementt,$evenementRepository);}
       }
        
        
       $evenement = $paginator->paginate(
        $donnees, // Requête contenant les données à paginer (ici nos articles)
        $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
        6 // Nombre de résultats par page
    );

        return $this->render('client/index.html.twig', [
            'evenements' => $evenement,
            
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
    #[Route('/{id}/ticketsg', name: 'app_evenement_gagnante', methods: ['GET'])]
    public function ticketsgagnate(Evenement $evenement)
    {
        
       

        $a =null;
       $b=null;
       $ttickets = $this->getDoctrine()->getRepository(Ticket::class)->findBy([
        'Evenement' => $evenement,
        'Status' => true,
    ]);
       
   

        

        return $this->render('admin/ticketgagnate.html.twig', [
            'evenement' => $evenement,
            'tickets' => $ttickets,
        ]);
    }
    

}
