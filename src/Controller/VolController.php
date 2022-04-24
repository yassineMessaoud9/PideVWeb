<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\VolType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VolRepository;
use DateTime;

/**
 * @Route("/vol")
 */
class VolController extends AbstractController
{
    /**
     * @Route("/", name="app_vol_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $vols = $entityManager
            ->getRepository(Vol::class)
            ->findAll();

        return $this->render('vol/index.html.twig', [
            'vols' => $vols,
        ]);
    }





    /**
     * @Route("/reservation", name="app_vol_index2", methods={"GET"})
     */
    public function index2(EntityManagerInterface $entityManager): Response
    {
        $vols = $entityManager
            ->getRepository(Vol::class)
            ->findAll();

        return $this->render('vol/reservervol.html.twig', [
            'vols' => $vols,
        ]);
    }

    /**
     * @Route("/new", name="app_vol_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vol = new Vol();
        $form = $this->createForm(VolType::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vol);
            $entityManager->flush();

            return $this->redirectToRoute('app_vol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vol/new.html.twig', [
            'vol' => $vol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{numvol}", name="app_vol_show", methods={"GET"})
     */
    public function show(Vol $vol): Response
    {
        return $this->render('vol/show.html.twig', [
            'vol' => $vol,
        ]);
    }

    /**
     * @Route("/{numvol}/edit", name="app_vol_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Vol $vol, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VolType::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vol/edit.html.twig', [
            'vol' => $vol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{numvol}", name="app_vol_delete", methods={"POST"})
     */
    public function delete(Request $request, Vol $vol, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vol->getNumvol(), $request->request->get('_token'))) {
            $entityManager->remove($vol);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vol_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/", name="app_recherche_date", methods={"POST"})
     */
    public function rechercherdate(Request $request,VolRepository $A)
    {
        $em = $this-> getDoctrine()->getManager();
        $vol=$em->getRepository(Vol::class)->findall();
        if( $request->isMethod("POST") )
        {
            $datealler =$request->get('datealler');
            $dateretour =$request->get('dateretour');
            
            $d=new DateTime('2022-03-05');
            

            $vol =$A->finddate( $datealler, $dateretour);
        }

        return $this->render('vol/index.html.twig', [
            'vols' => $vol,
        ]);
    }

    
}
