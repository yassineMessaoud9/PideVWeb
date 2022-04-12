<?php

namespace App\Controller;

use App\Entity\Commandrestau;
use App\Form\CommandrestauType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commandrestau")
 */
class CommandrestauController extends AbstractController
{
    /**
     * @Route("/", name="app_commandrestau_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $commandrestaus = $entityManager
            ->getRepository(Commandrestau::class)
            ->findAll();

        return $this->render('commandrestau/index.html.twig', [
            'commandrestaus' => $commandrestaus,
        ]);
    }

    /**
     * @Route("/new", name="app_commandrestau_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commandrestau = new Commandrestau();
        $form = $this->createForm(CommandrestauType::class, $commandrestau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commandrestau);
            $entityManager->flush();

            return $this->redirectToRoute('app_commandrestau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commandrestau/new.html.twig', [
            'commandrestau' => $commandrestau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{numCommande}", name="app_commandrestau_show", methods={"GET"})
     */
    public function show(Commandrestau $commandrestau): Response
    {
        return $this->render('commandrestau/show.html.twig', [
            'commandrestau' => $commandrestau,
        ]);
    }

    /**
     * @Route("/{numCommande}/edit", name="app_commandrestau_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Commandrestau $commandrestau, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandrestauType::class, $commandrestau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commandrestau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commandrestau/edit.html.twig', [
            'commandrestau' => $commandrestau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{numCommande}", name="app_commandrestau_delete", methods={"POST"})
     */
    public function delete(Request $request, Commandrestau $commandrestau, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandrestau->getNumCommande(), $request->request->get('_token'))) {
            $entityManager->remove($commandrestau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commandrestau_index', [], Response::HTTP_SEE_OTHER);
    }
}
