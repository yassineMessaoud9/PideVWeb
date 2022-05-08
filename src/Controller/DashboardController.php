<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController','user'=>$user
        ]);
    }

    
    /**
     * @Route("/DashboardMobile", name="app_dashboardm", methods={"GET"})
     */
    public function HomeMobile(
        UtilisateurRepository $utilisateurRepository,NormalizerInterface $Normalizer
    ): Response {
        $data = $utilisateurRepository->findAll();
        $jsonContent = $Normalizer->normalize($data, 'json', ['groups' => 'Utilisateur:read']);
        return new Response(json_encode($jsonContent));

    }
}
