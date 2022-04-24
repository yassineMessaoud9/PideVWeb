<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * @Route("/adresse")
 */
class AdresseController extends AbstractController
{
    /**
     * @Route("/", name="app_adresse_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $adresses = $entityManager
            ->getRepository(Adresse::class)
            ->findAll();

        return $this->render('adresse/index.html.twig', [
            'adresses' => $adresses,
        ]);
    }

    /**
     * @Route("/new", name="app_adresse_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adresse);
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adresse/new.html.twig', [
            'adresse' => $adresse,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/omarftr" , name="print")
     */
    public function Print(EntityManagerInterface $entityManager):Response
    {
        $pdfoptions=new Options();

        $pdfoptions->set('defaultFont','Arial');
        $pdfoptions->setIsRemoteEnabled(true);
        $pdfoptions->set('isHtml5ParserEnabled',true);
        $pdfoptions->set('isRemoteEnabled',true);
        $dompdf= new Dompdf($pdfoptions);
        $adresse = $entityManager
            ->getRepository(adresse::class)
            ->findAll();
        $html=$this->renderView('adresse/pdf.html.twig',[
            'adresses' => $adresse

        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');

        $dompdf->render();
        //$dompdf->stream("yassinepdf.pdf", ["Attachment"=>true]);
        $dompdf->stream("asmapdf.pdf", ["Attachment"=>false]);

    }













    /**
     * @Route("/{idadresse}", name="app_adresse_show", methods={"GET"})
     */
    public function show(Adresse $adresse): Response
    {
        return $this->render('adresse/show.html.twig', [
            'adresse' => $adresse,
        ]);
    }

    /**
     * @Route("/{idadresse}/edit", name="app_adresse_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Adresse $adresse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idadresse}", name="app_adresse_delete", methods={"POST"})
     */
    public function delete(Request $request, Adresse $adresse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getIdadresse(), $request->request->get('_token'))) {
            $entityManager->remove($adresse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
    }
}
