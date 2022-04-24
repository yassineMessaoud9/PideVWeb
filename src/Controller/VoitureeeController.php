<?php

namespace App\Controller;

use App\Entity\Voitureee;
use App\Form\VoitureeeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voitureee")
 */
class VoitureeeController extends AbstractController
{
    /**
     * @Route("/", name="app_voitureee_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voitureees = $entityManager
            ->getRepository(Voitureee::class)
            ->findAll();

        return $this->render('voitureee/index.html.twig', [
            'voitureees' => $voitureees,
        ]);
    }

    /**
     * @Route("/new", name="app_voitureee_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voitureee = new Voitureee();
        $form = $this->createForm(VoitureeeType::class, $voitureee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voitureee);
            $entityManager->flush();

            return $this->redirectToRoute('app_voitureee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voitureee/new.html.twig', [
            'voitureee' => $voitureee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{matricule}", name="app_voitureee_show", methods={"GET"})
     */
    public function show(Voitureee $voitureee): Response
    {
        return $this->render('voitureee/show.html.twig', [
            'voitureee' => $voitureee,
        ]);
    }

    /**
     * @Route("/{matricule}/edit", name="app_voitureee_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Voitureee $voitureee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoitureeeType::class, $voitureee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voitureee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voitureee/edit.html.twig', [
            'voitureee' => $voitureee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{matricule}", name="app_voitureee_delete", methods={"POST"})
     */
    public function delete(Request $request, Voitureee $voitureee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voitureee->getMatricule(), $request->request->get('_token'))) {
            $entityManager->remove($voitureee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voitureee_index', [], Response::HTTP_SEE_OTHER);
    }
}
