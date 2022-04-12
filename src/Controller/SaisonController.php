<?php

namespace App\Controller;

use App\Entity\Saison;
use App\Form\SaisonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/saison")
 */
class SaisonController extends AbstractController
{
    /**
     * @Route("/", name="app_saison_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $saisons = $entityManager
            ->getRepository(Saison::class)
            ->findAll();

        return $this->render('saison/index.html.twig', [
            'saisons' => $saisons,
        ]);
    }

    /**
     * @Route("/new", name="app_saison_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $saison = new Saison();
        $form = $this->createForm(SaisonType::class, $saison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($saison);
            $entityManager->flush();

            return $this->redirectToRoute('app_saison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('saison/new.html.twig', [
            'saison' => $saison,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idsaison}", name="app_saison_show", methods={"GET"})
     */
    public function show(Saison $saison): Response
    {
        return $this->render('saison/show.html.twig', [
            'saison' => $saison,
        ]);
    }

    /**
     * @Route("/{idsaison}/edit", name="app_saison_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Saison $saison, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SaisonType::class, $saison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_saison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('saison/edit.html.twig', [
            'saison' => $saison,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idsaison}", name="app_saison_delete", methods={"POST"})
     */
    public function delete(Request $request, Saison $saison, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saison->getIdsaison(), $request->request->get('_token'))) {
            $entityManager->remove($saison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_saison_index', [], Response::HTTP_SEE_OTHER);
    }
}
