<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\voitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/voiture")
 */
class VoitureController extends AbstractController
{
    /**
     * @Route("/", name="app_voiture_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voitures = $entityManager
            ->getRepository(voiture::class)
            ->findAll();

        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    /**
     * @Route("/list", name="app_voiture_indexFront", methods={"GET"})
     */
    public function indexFront(EntityManagerInterface $entityManager): Response
    {
        $voitures = $entityManager
            ->getRepository(voiture::class)
            ->findAll();

        return $this->render('voiture/indexFront.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    /**
     * @Route("/new", name="app_voiture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new voiture();
        $form = $this->createForm(voitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

/**
     * @Route ("/pdf" , name="print")
     */
    public function Print(EntityManagerInterface $entityManager):Response
    {
        $pdfoptions=new Options();

        $pdfoptions->set('defaultFont','Arial');
        $pdfoptions->setIsRemoteEnabled(true);
        $pdfoptions->set('isHtml5ParserEnabled',true);
        $pdfoptions->set('isRemoteEnabled',true);
        $dompdf= new Dompdf($pdfoptions);
        $voiture = $entityManager
            ->getRepository(voiture::class)
            ->findAll();
        $html=$this->renderView('voiture/pdf.html.twig',[
            'voitures' => $voiture

        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');

        $dompdf->render();
        //$dompdf->stream("yassinepdf.pdf", ["Attachment"=>true]);
        $dompdf->stream("asmapdf.pdf", ["Attachment"=>false]);

    }



    /**
     * @Route("/stats",name="stats")
     */
    public function statistique(VoitureRepository $VoitureRepository,EntityManagerInterface $entityManager)
    {
        $voitures = $entityManager
        ->getRepository(voiture::class)
        ->findAll();
        $marquevoiture= [];
        $tarif= [];
        foreach($voitures as $voiture){
            $marquevoiture[]=$voiture->getMarquevoiture();
            $tarif[]=$voiture->getTarif();
        }
        return $this->render('voiture/stats.html.twig',[
            'marquevoiture' =>json_encode($marquevoiture),
            'tarif' =>json_encode($tarif)
        ]);
    }






    /**
     * @Route("/{idVoiture}", name="app_voiture_show", methods={"GET"},requirements={"id":"\d+"})
     */
    public function show(voiture $voiture): Response
    {
        return $this->render('voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    /**
     * @Route("/{idVoiture}/edit", name="app_voiture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(voitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idVoiture}", name="app_voiture_delete", methods={"POST"})
     */
    public function delete(Request $request, voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getIdVoiture(), $request->request->get('_token'))) {
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voiture_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/", name="app_recherche", methods={"POST"})
     */
    public function rechercher(Request $request,VoitureRepository $V)
    {
        $em = $this-> getDoctrine()->getManager();
        $voiture=$em->getRepository(Voiture::class)->findall();
        if( $request->isMethod("POST"))
        {
            $marque =$request->get('marquevoiture');
            

            $voiture =$V->findEntities($marque);
        }

        return $this->render('voiture/index.html.twig', [
            'voitures' => $voiture,
        ]);
    }


}
