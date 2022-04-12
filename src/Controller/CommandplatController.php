<?php

namespace App\Controller;

use App\Entity\Commandplat;
use App\Form\CommandplatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commandplat")
 */
class CommandplatController extends AbstractController
{
    /**
     * @Route("/", name="app_commandplat_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $commandplats = $entityManager
            ->getRepository(Commandplat::class)
            ->findAll();

        return $this->render('commandplat/index.html.twig', [
            'commandplats' => $commandplats,
        ]);
    }

    /**
     * @Route("/new", name="app_commandplat_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commandplat = new Commandplat();
        $form = $this->createForm(CommandplatType::class, $commandplat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commandplat);
            $entityManager->flush();

            return $this->redirectToRoute('app_commandplat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commandplat/new.html.twig', [
            'commandplat' => $commandplat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_commandplat_show", methods={"GET"})
     */
    public function show(Commandplat $commandplat): Response
    {
        return $this->render('commandplat/show.html.twig', [
            'commandplat' => $commandplat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_commandplat_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Commandplat $commandplat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandplatType::class, $commandplat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commandplat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commandplat/edit.html.twig', [
            'commandplat' => $commandplat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_commandplat_delete", methods={"POST"})
     */
    public function delete(Request $request, Commandplat $commandplat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandplat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commandplat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commandplat_index', [], Response::HTTP_SEE_OTHER);
    }
}
