<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\CamionRepository;
use App\Repository\MissionRepository;
use App\Repository\SignalisationRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


#[Route('/mission')]
class MissionController extends AbstractController
{
    //method permet to get list of mission granted than date current
    #[Route('/', name: 'app_mission_index', methods: ['GET'])]
    public function index(MissionRepository $missionRepository): Response
    {
        return $this->render('mission/index.html.twig', [
            'missions' => $missionRepository->findAllGrantedThanDateCurrent(),
        ]);
    }

    //method permet to display collectors and camion affected to mission with date mission all details of mission 
    #[Route('/Details/{id}', name: 'app_mission_details', methods: ['GET'])]
    public function show_details_mission(MissionRepository $missionRepository, UserRepository $userRepository, int $id, Mission $mission): Response
    {
        $mission = $missionRepository->find($id);
        $camion = $mission->getCamion();
        $collecteurs = $userRepository->findMissionCollecteurs($mission);
        return $this->render('mission/displayMissionSignalisation.html.twig', [
            'mission' => $mission,
            'collecteurs' => $collecteurs,
            'camion' => $camion,
        ]);
    }
    //method permet to create mission bac and affect to collectors , camion and bac to this mission
    #[Route('/new', name: 'app_mission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MissionRepository $missionRepository): Response
    {

        $mission = new Mission;
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);
            $mission->setTypeMission("bac_Mission");
            return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission/new.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    //method permet to get all the list of mission
    #[Route('/historique', name: 'app_mission_index_historique', methods: ['GET'])]
    public function index_historique( MissionRepository $missionRepository, Request $request): Response
    {
        $missions = $missionRepository->findAll();
        // Paginate the data
    
        return $this->render('mission/historique.html.twig', [
            
            'missions' => $missionRepository->findAll(),
        ]);
    }

    //method permet to get missionById and show it
    #[Route('/{id}', name: 'app_mission_show', methods: ['GET'])]
    public function show(Mission $mission): Response
    {
        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
        ]);
    }


    //method permet to create mission with display map that indicat localisation of signalisation and affect 3  available collectors and camion disponible to this mission of sinalisation
    #[Route('/signalisation/{idSignal}', name: 'app_mission_signalisation', methods: ['GET', 'POST'])]
    public function traiter_signalisation(Request $request, UserRepository $userRepository, CamionRepository $camionRepository, int $idSignal, SignalisationRepository $signalisationRepository, MissionRepository $missionRepository): Response
    {
        $signalisation = $signalisationRepository->findOneById($idSignal);

        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = $form->get('dateMission')->getData();
            $collecteurs =  $userRepository->findUsersWithRoleCollecteur($date);
            $collecteursArray = new ArrayCollection($collecteurs);
            $signalisation->setTraited(true);
            $mission->setTypeMission("signalisation_Mission");
            $camion = $camionRepository->findCamionDisponible($date);
            $mission->setCollecteurs($collecteursArray);
            $mission->setSignalisation($signalisation);
            $mission->setCamion($camion[0]);

            $missionRepository->save($mission, true);
            /*   foreach ($collecteurs as $collecteur) {
                $phoneNumber = $collecteur->getPhoneNumber();
                $serieCamion = $camion->getMatricule();
                //sendSmsService......
            }*/
            $this->addFlash('success', 'The collectors have been successfully affected.');
            return $this->render('signalisation/allSignalisation.html.twig', ['signalisations' => $signalisationRepository->findAll()]);
        }

        return $this->renderForm('signalisation/traiter.html.twig', [
            'mission' => $mission,
            'form' => $form,
            'signalisation' => $signalisation,

        ]);
    }

    //method permet to create mission and affect 3  available collectors to this mission of get dechet from bac
    #[Route('/parametrage/{id}', name: 'app_mission_parametrage', methods: ['GET'])]
    public function parametrer_mission_Bac(MissionRepository $missionRepository, UserRepository $userRepository, int $id, Mission $mission): Response
    {
        $mission = $missionRepository->find($id);
        $camion = $mission->getCamion();
        $coll = $mission->getCollecteurs();
        $collecteurs = $userRepository->findMissionCollecteurs($mission);
        return $this->render('mission/parametrage.html.twig', [
            'mission' => $mission,
            'collecteurs' => $collecteurs,
            'camion' => $camion,
        ]);
    }

    //method permet to get missionById and update it 
    #[Route('/{id}/edit', name: 'app_mission_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mission $mission, MissionRepository $missionRepository): Response
    {
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);

            return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission/edit.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    //method permet to delete missionById
    #[Route('/{id}', name: 'app_mission_delete', methods: ['POST'])]
    public function delete(Request $request, Mission $mission, MissionRepository $missionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mission->getId(), $request->request->get('_token'))) {
            $missionRepository->remove($mission, true);
        }

        return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
    }
}
