<?php

namespace App\Controller;

use App\dto\Pie;
use App\Repository\SignalisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends AbstractController
{ //method permet to display pie chart with analyse in dashboard admin
    #[Route('/dashboard', name: 'app_template_dashboard')]
    public function dashboard_index(SignalisationRepository $signalisationRepository): Response
    {
        $results = $signalisationRepository->countByRegion();
        //   dd($results);
        $totalCount = array_reduce($results, function ($carry, $result) {
            return $carry + $result['signalisation_count'];
        }, 0);
        $resultArray = [];
        foreach ($results as $result) {
            $percentage = round(($result['signalisation_count'] / $totalCount) * 100);
            $obj = new Pie();
            $obj->value = $result['region'];
            $obj->valeur = $percentage;
            $resultArray[] = $obj;
        }
        //dd($resultArray);
        return $this->render('admin/base.html.twig', [
            'results' => $resultArray,

        ]);
    }


    #[Route('/home', name: 'app_template_home')]
    public function home_index(): Response
    {
        return $this->render('client/base.html.twig');
    }
}
