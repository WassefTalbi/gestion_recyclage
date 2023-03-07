<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccessdeniedController extends AbstractController
{
    #[Route('/access_denied', name: 'app_accessdenied')]
    public function index(): Response
    {
        return $this->render('accessdenied.html.twig', [
            'controller_name' => 'AccessdeniedController',
        ]);
    }
}
