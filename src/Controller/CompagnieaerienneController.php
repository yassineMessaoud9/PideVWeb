<?php

namespace App\Controller;

use App\Entity\Compagnieaerienne;
use App\Form\CompagnieaerienneType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/compagnieaerienne")
 */
class CompagnieaerienneController extends AbstractController
{
    /**
     * @Route("/", name="app_compagnieaerienne_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $compagnieaeriennes = $entityManager
            ->getRepository(Compagnieaerienne::class)
            ->findAll();

        return $this->render('compagnieaerienne/index.html.twig', [
            'compagnieaeriennes' => $compagnieaeriennes,
        ]);
    }

    /**
     * @Route("/new", name="app_compagnieaerienne_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $compagnieaerienne = new Compagnieaerienne();
        $form = $this->createForm(CompagnieaerienneType::class, $compagnieaerienne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($compagnieaerienne);
            $entityManager->flush();

            return $this->redirectToRoute('app_compagnieaerienne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compagnieaerienne/new.html.twig', [
            'compagnieaerienne' => $compagnieaerienne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcompagnie}", name="app_compagnieaerienne_show", methods={"GET"})
     */
    public function show(Compagnieaerienne $compagnieaerienne): Response
    {
        return $this->render('compagnieaerienne/show.html.twig', [
            'compagnieaerienne' => $compagnieaerienne,
        ]);
    }

    /**
     * @Route("/{idcompagnie}/edit", name="app_compagnieaerienne_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Compagnieaerienne $compagnieaerienne, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompagnieaerienneType::class, $compagnieaerienne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_compagnieaerienne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compagnieaerienne/edit.html.twig', [
            'compagnieaerienne' => $compagnieaerienne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcompagnie}", name="app_compagnieaerienne_delete", methods={"POST"})
     */
    public function delete(Request $request, Compagnieaerienne $compagnieaerienne, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compagnieaerienne->getIdcompagnie(), $request->request->get('_token'))) {
            $entityManager->remove($compagnieaerienne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_compagnieaerienne_index', [], Response::HTTP_SEE_OTHER);
    }
}
