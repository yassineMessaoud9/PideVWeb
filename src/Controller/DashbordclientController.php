<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashbordclientController extends AbstractController
{
    /**
     * @Route("/dashbordclient", name="app_dashbordclient")
     */
    public function index(): Response
    {
        return $this->render('dashbordclient/index.html.twig', [
            'controller_name' => 'DashbordclientController',
        ]);
    }

    
}
