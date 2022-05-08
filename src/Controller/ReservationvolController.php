<?php

namespace App\Controller;

use App\Entity\Reservationvol;
use App\Entity\Vol;
use App\Form\ReservationvolType;
use App\Repository\VolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
/**
 * @Route("/reservationvol")
 */
class ReservationvolController extends AbstractController
{
    /**
     * @Route("/", name="app_reservationvol_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservationvols = $entityManager
            ->getRepository(Reservationvol::class)
            ->findAll();

        return $this->render('reservationvol/index.html.twig', [
            'reservationvols' => $reservationvols,
        ]);
    }

    /**
     * @Route("/new", name="app_reservationvol_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, VolRepository $volRepository): Response
    {
        $reservationvol = new Reservationvol();
        $form = $this->createForm(ReservationvolType::class, $reservationvol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vol=$volRepository->find($form["numvol"]->getData());
            $datedebut=$vol->getDateallervol()->format('Y-m-d H:i:s');
            $datefin=$vol->getDateretourvol()->format('Y-m-d H:i:s');
           
            $data=$this->difference_of_days($datedebut,$datefin); 
            






            // $entityManager->persist($reservationvol);
            // $entityManager->flush();

            return $this->redirectToRoute('app_reservationvol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationvol/new.html.twig', [
            'reservationvol' => $reservationvol,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("landingpage/new2", name="app_reservationvol2_new", methods={"GET", "POST"})
     */
    public function new2(Request $request, EntityManagerInterface $entityManager,VolRepository $volRepository): Response

    {   $vol=$_GET['numvol'];
      
           
        $voll=$volRepository->find($vol);
      
      
             $datedebut=$voll->getDateallervol()->format('Y-m-d');
           
            $datefin=$voll->getDateretourvol()->format('Y-m-d');
            $dest=$voll->getDestination();
            $montant=$voll->getPrixvol();
            $class=$voll->getClassvol();
            $tempsaller=$voll->getTempallervol();
           $tempsretour=$voll->getTempretourvol();
             $data=$this->difference_of_days($datedebut,$datefin); 
             
              
            //  $volR= ((float)$vol );
            //  var_dump($volR);

          
            
        $reservationvol = new Reservationvol();
        $form = $this->createForm(ReservationvolType::class, $reservationvol);
        $form->handleRequest($request);
       
        

        if ($form->isSubmitted() && $form->isValid()) {
          

            $reservationvol->setNumvol($voll);
            $entityManager->persist($reservationvol);
            $entityManager->flush();
            $pdfoptions=new Options();

        $pdfoptions->set('defaultFont','Arial');
        $pdfoptions->setIsRemoteEnabled(true);
        $pdfoptions->set('isHtml5ParserEnabled',true);
        $pdfoptions->set('isRemoteEnabled',true);
        $dompdf= new Dompdf($pdfoptions);
        $reservationvol = $entityManager
            ->getRepository(reservationvol::class)
            ->findAll();
        $html=$this->renderView('reservationvol/pdf.html.twig',[
            'reservationvol' => $reservationvol,
            'nbrjours' => $data,
            'vol' =>$vol,
            'dateallervol'=>$datedebut,
            'destination'=>$dest,
            'dateretourvol'=>$datefin,
            'prixvol'=>$montant,
            'classvol'=>$class,
            'tempaller'=>$tempsaller,
            'tempretour'=>$tempsretour,

        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');

        $dompdf->render();
     
        $dompdf->stream("omar.pdf", ["Attachment"=>false]);

           
        }

        return $this->render('reservationvol/new2.html.twig', [
            'reservationvol' => $reservationvol,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route ("/pdffacture" , name="printfacture")
     */
    public function Print(EntityManagerInterface $entityManager):Response
    {
        $pdfoptions=new Options();

        $pdfoptions->set('defaultFont','Arial');
        $pdfoptions->setIsRemoteEnabled(true);
        $pdfoptions->set('isHtml5ParserEnabled',true);
        $pdfoptions->set('isRemoteEnabled',true);
        $dompdf= new Dompdf($pdfoptions);
        $reservationvol = $entityManager
            ->getRepository(reservationvol::class)
            ->findAll();
        $html=$this->renderView('reservationvol/pdf.html.twig',[
            'reservationvol' => $reservationvol,
            

        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');

        $dompdf->render();
     
        $dompdf->stream("omar.pdf", ["Attachment"=>false]);

    }

    /**
     * @Route("/{idreservationvol}", name="app_reservationvol_show", methods={"GET"})
     */
    public function show(Reservationvol $reservationvol): Response
    {
        return $this->render('reservationvol/show.html.twig', [
            'reservationvol' => $reservationvol,
        ]);
    }

    /**
     * @Route("/{idreservationvol}/edit", name="app_reservationvol_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reservationvol $reservationvol, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationvolType::class, $reservationvol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationvol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationvol/edit.html.twig', [
            'reservationvol' => $reservationvol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idreservationvol}", name="app_reservationvol_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservationvol $reservationvol, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationvol->getIdreservationvol(), $request->request->get('_token'))) {
            $entityManager->remove($reservationvol);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservationvol_index', [], Response::HTTP_SEE_OTHER);
    }


    public function difference_of_days(String $datedebutlocation, String $datefinlocation){

        $dureesejour = (strtotime($datefinlocation) - strtotime($datedebutlocation)); 

        return round($dureesejour / (60 * 60 * 24));

    }


}
