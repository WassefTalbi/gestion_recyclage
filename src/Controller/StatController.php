<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Bac;
use App\Entity\Dechet;
class StatController extends AbstractController
{
    /**
     * @Route("/stat", name="app_stat")
     */
    public function index(): Response
    {
        return $this->render('stat/index.html.twig', [
            'controller_name' => 'StatController',
        ]);
    }

    /**
     * @Route("/stats", name="stats")
     */
    public function index2()
    {
        $bacRepo = $this->getDoctrine()->getRepository(Bac::class);
        $dechetRepo = $this->getDoctrine()->getRepository(Dechet::class);

        $bacs = $bacRepo->createQueryBuilder('b')
            ->select('b.id, COUNT(b.id) as count')
            ->groupBy('b.id')
            ->getQuery()
            ->getResult();

        $dechets = $dechetRepo->createQueryBuilder('d')
            ->select('d.id, COUNT(d.id) as count')
            ->groupBy('d.id')
            ->getQuery()
            ->getResult();
        $bacLabels = array_map(function($data) { return $data['id']; }, $bacs);
        $bacValues = array_map(function($data) { return $data['count']; }, $bacs);
        $dechetLabels = array_map(function($data) { return $data['id']; }, $dechets);
        $dechetValues = array_map(function($data) { return $data['count']; }, $dechets);

        // Render the template with the data
        return $this->render('stat/index.html.twig', [
            'bacLabels' => json_encode($bacLabels),
            'bacValues' => json_encode($bacValues),
            'dechetLabels' => json_encode($dechetLabels),
            'dechetValues' => json_encode($dechetValues),
        ]);



    }
}

