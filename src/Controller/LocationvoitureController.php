<?php

namespace App\Controller;

use App\Entity\Locationvoiture;
use App\Entity\Voiture;
use App\Form\LocationvoitureType;
use App\Repository\VoitureRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\LocationvoitureRepository;
/**
 * @Route("/locationvoiture")
 */
class LocationvoitureController extends AbstractController
{
    /**
     * @Route("/", name="app_locationvoiture_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $locationvoitures = $entityManager
            ->getRepository(Locationvoiture::class)
            ->findAll();

        return $this->render('locationvoiture/index.html.twig', [
            'locationvoitures' => $locationvoitures,
        ]);
    }


    /**
     * @Route("/new", name="app_locationvoiture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,VoitureRepository $voitureRepository): Response
    {
        $locationvoiture = new Locationvoiture();

        $form = $this->createForm(LocationvoitureType::class, $locationvoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $datedebut = $form["datedebutlocation"]->getData()->format('Y-m-d H:i:s');
            $datefin = $form["datefinlocation"]->getData()->format('Y-m-d H:i:s');  
            $days=$this->difference_of_days($datedebut,$datefin); 
            $voiture=$voitureRepository->find($form["id_voiture"]->getData());
           $total=$voiture->getTarif(); 
          
          $montant= $total * $days; 

          $marque=$voiture->getMarquevoiture(); 


            $locationvoiture->setMontant($montant);

         

             $entityManager->persist($locationvoiture);
              $entityManager->flush();
             $test= ((string)$montant );
             $idlocation =$locationvoiture->getIdlocation();
             var_dump($idlocation);
          
        

         return $this->render('locationvoiture/indexpopup.html.twig', 
            ['montant'=>  $test,'days'=>$days ,'marque'=>$marque, 'idlocation'=> $idlocation,
        ]);
        }

        return $this->render('locationvoiture/new.html.twig', [
            'locationvoiture' => $locationvoiture,
            'form' => $form->createView(),
        ]);
    }

    

    /**
     * @Route ("/pdffacture" , name="printfacture")
     */
    public function Print(EntityManagerInterface $entityManager,LocationvoitureRepository $LocationvoitureRepository,VoitureRepository $voitureRepository):Response
    {


        $location=$_GET['idlocation'];
       $locationvoitureee= $LocationvoitureRepository->find($location);
       dd( $locationvoitureee);
        $pdfoptions=new Options();

        $pdfoptions->set('defaultFont','Arial');
        $pdfoptions->setIsRemoteEnabled(true);
        $pdfoptions->set('isHtml5ParserEnabled',true);
        $pdfoptions->set('isRemoteEnabled',true);




        $dompdf= new Dompdf($pdfoptions);
        $locationvoiture = $entityManager
            ->getRepository(locationvoiture::class)
            ->findAll();
          $Datedebutlocation = $locationvoitureee->getDatedebutlocation();
          $Datefinlocation = $locationvoitureee->getDatefinlocation();
          $idVoiture = $locationvoitureee->getIdVoiture();
          $voiture=$voitureRepository->find($idVoiture);
          $marque=$voiture->getMarquevoiture(); 
          



        $html=$this->renderView('locationvoiture/pdf.html.twig',[
            'locationvoiture' => $locationvoiture

        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');

        $dompdf->render();
     
        $dompdf->stream("ons.pdf", ["Attachment"=>false]);

    }

    /**
     * @Route("/{idlocation}", name="app_locationvoiture_show", methods={"GET"})
     */
    public function show(Locationvoiture $locationvoiture): Response
    {
        return $this->render('locationvoiture/show.html.twig', [
            'locationvoiture' => $locationvoiture,
        ]);
    }

    /**
     * @Route("/{idlocation}/edit", name="app_locationvoiture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Locationvoiture $locationvoiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocationvoitureType::class, $locationvoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_locationvoiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('locationvoiture/edit.html.twig', [
            'locationvoiture' => $locationvoiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idlocation}", name="app_locationvoiture_delete", methods={"POST"})
     */
    public function delete(Request $request, Locationvoiture $locationvoiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$locationvoiture->getIdlocation(), $request->request->get('_token'))) {
            $entityManager->remove($locationvoiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_locationvoiture_index', [], Response::HTTP_SEE_OTHER);
    }



    public function difference_of_days(String $datedebutlocation, String $datefinlocation){

        $dureesejour = (strtotime($datefinlocation) - strtotime($datedebutlocation)); 

        return round($dureesejour / (60 * 60 * 24));

    }
   
    
}
