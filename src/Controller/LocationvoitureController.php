<?php

namespace App\Controller;

use App\Entity\Locationvoiture;
use App\Form\LocationvoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/locationvoiture")
 */
class LocationvoitureController extends AbstractController
{
    /**
     * @Route("/", name="app_locationvoiture_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $locationvoitures = $entityManager
            ->getRepository(Locationvoiture::class)
            ->findAll();

        return $this->render('locationvoiture/index.html.twig', [
            'locationvoitures' => $locationvoitures,
        ]);
    }


    /**
     * @Route("/new", name="app_locationvoiture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $locationvoiture = new Locationvoiture();
        $form = $this->createForm(LocationvoitureType::class, $locationvoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($locationvoiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_locationvoiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('locationvoiture/new.html.twig', [
            'locationvoiture' => $locationvoiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idlocation}", name="app_locationvoiture_show", methods={"GET"})
     */
    public function show(Locationvoiture $locationvoiture): Response
    {
        return $this->render('locationvoiture/show.html.twig', [
            'locationvoiture' => $locationvoiture,
        ]);
    }

    /**
     * @Route("/{idlocation}/edit", name="app_locationvoiture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Locationvoiture $locationvoiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocationvoitureType::class, $locationvoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_locationvoiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('locationvoiture/edit.html.twig', [
            'locationvoiture' => $locationvoiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idlocation}", name="app_locationvoiture_delete", methods={"POST"})
     */
    public function delete(Request $request, Locationvoiture $locationvoiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$locationvoiture->getIdlocation(), $request->request->get('_token'))) {
            $entityManager->remove($locationvoiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_locationvoiture_index', [], Response::HTTP_SEE_OTHER);
    }
}
