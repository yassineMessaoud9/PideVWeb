<?php

namespace App\Controller;

use App\Entity\Avion;
use App\Form\AvionType;
use App\Repository\AvionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/avion")
 */
class AvionController extends AbstractController
{
    /**
     * @Route("/", name="app_avion_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $avions = $entityManager
            ->getRepository(Avion::class)
            ->findAll();

        return $this->render('avion/index.html.twig', [
            'avions' => $avions,
        ]);
    }

    /**
     * @Route("/new", name="app_avion_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avion = new Avion();
        $form = $this->createForm(AvionType::class, $avion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avion);
            $entityManager->flush();

            return $this->redirectToRoute('app_avion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avion/new.html.twig', [
            'avion' => $avion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{numserieavion}", name="app_avion_show", methods={"GET"})
     */
    public function show(Avion $avion): Response
    {
        return $this->render('avion/show.html.twig', [
            'avion' => $avion,
        ]);
    }

    /**
     * @Route("/{numserieavion}/edit", name="app_avion_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Avion $avion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvionType::class, $avion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avion/edit.html.twig', [
            'avion' => $avion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{numserieavion}", name="app_avion_delete", methods={"POST"})
     */
    public function delete(Request $request, Avion $avion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avion->getNumserieavion(), $request->request->get('_token'))) {
            $entityManager->remove($avion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avion_index', [], Response::HTTP_SEE_OTHER);
    }
     /**
     * @Route("/", name="app_recherche", methods={"POST"})
     */
    public function rechercher(Request $request,AvionRepository $A)
    {
        $em = $this-> getDoctrine()->getManager();
        $avion=$em->getRepository(Avion::class)->findall();
        if( $request->isMethod("POST"))
        {
            $marque =$request->get('marque');
            

            $avion =$A->findEntities($marque);
        }

        return $this->render('avion/index.html.twig', [
            'avions' => $avion,
        ]);
    }
/**
     * @Route("/trier/list", name="trierD")
      */
      public function trierF(AvionRepository $repository, Request $request)
      {
        
      
        $formations=$repository->tri();
         
        return $this->render('avion/index.html.twig', [
            'avions' => $formations
        ]);
        }

 

}
