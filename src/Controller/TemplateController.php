<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends AbstractController
{
    #[Route('/dashboard', name: 'app_template_dashboard')]
    public function dashboard_index(): Response
    {
        return $this->render('admin/base.html.twig');
    }


    #[Route('/home', name: 'app_template_home')]
    public function home_index(): Response
    {
        return $this->render('client/base.html.twig');
    }
}
