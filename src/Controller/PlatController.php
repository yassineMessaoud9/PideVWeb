<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plat")
 */
class PlatController extends AbstractController
{
    /**
     * @Route("/", name="app_plat_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $plats = $entityManager
            ->getRepository(Plat::class)
            ->findAll();

        return $this->render('plat/index.html.twig', [
            'plats' => $plats,
        ]);
    }

    /**
     * @Route("/new", name="app_plat_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $file = $form->get('photoplat')->getData();
              $Filename = md5(uniqid()).'.'.$file->guessExtension();
        try {
            $file->move(
                $this->getParameter('images'),
                $Filename
            );
        } catch (FileException $e) {

        }



        $plat->setPhotoplat($Filename);
      
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plat/new.html.twig', [
            'plat' => $plat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idplat}", name="app_plat_show", methods={"GET"})
     */
    public function show(Plat $plat): Response
    {
        return $this->render('plat/show.html.twig', [
            'plat' => $plat,
        ]);
    }

    /**
     * @Route("/{idplat}/edit", name="app_plat_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Plat $plat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plat/edit.html.twig', [
            'plat' => $plat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idplat}", name="app_plat_delete", methods={"POST"})
     */
    public function delete(Request $request, Plat $plat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plat->getIdplat(), $request->request->get('_token'))) {
            $entityManager->remove($plat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
    }
}
