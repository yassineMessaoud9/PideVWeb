<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;
use Dompdf\Options;



/**
 * @Route("/hotel")
 */
class HotelController extends AbstractController
{
    /**
     * @Route("/", name="app_hotel_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager,PaginatorInterface $paginator, Request $request
    ): Response
    {
        $hotels = $entityManager
            ->getRepository(Hotel::class)
            ->findAll();
            // Paginate the results of the query
          $allhotels = $paginator->paginate(
            // Doctrine Query, not results
            $hotels,
            // Define the page parameter
    $request->query->getInt('page', 1),
            // Items per page
            2
        );

        return $this->render('hotel/index.html.twig', [
            'hotels' => $allhotels,
        ]);
    }
    /**
     * @Route("/landingpage", name="app_hotel2_index", methods={"GET"})
     */
    public function index4(EntityManagerInterface $entityManager): Response
    {
        $hotel = $entityManager
            ->getRepository(hotel::class)
            ->findAll();

        return $this->render('hotel/show2.html.twig', [
            'hotels' => $hotel,
        ]);
    }
      
    /**
     * @Route("/new", name="app_hotel_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('photo')->getData();
            $Filename = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_event'),
                    $Filename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }



            $hotel->setPhoto($Filename);
           

            $entityManager->persist($hotel);
            $entityManager->flush();

            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hotel/new.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }
      /**
     * @Route ("/asma" , name="print")
     */
    public function Print(EntityManagerInterface $entityManager):Response
    {
        $pdfoptions=new Options();
    

        $pdfoptions->set('defaultFont','Arial');
        $pdfoptions->setIsRemoteEnabled(true);
        $pdfoptions->set('isHtml5ParserEnabled',true);
        $pdfoptions->set('isRemoteEnabled',true);
        $dompdf= new Dompdf($pdfoptions);
        $allhotels = $entityManager
            ->getRepository(hotel::class)
            ->findAll();
        $html=$this->renderView('hotel/pdf.html.twig',[
            'hotels' => $allhotels

        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');

        $dompdf->render();
        //$dompdf->stream("yassinepdf.pdf", ["Attachment"=>true]);
        $dompdf->stream("asmapdf.pdf", ["Attachment"=>false]);

    }


    /**
     * @Route("/{idhotel}", name="app_hotel_show", methods={"GET"})
     */
    public function show(Hotel $hotel): Response
    {
        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotel,
        ]);
    }

    /**
     * @Route("/{idhotel}/edit", name="app_hotel_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Hotel $hotel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('photo')->getData();
            $Filename = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_event'),
                    $Filename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }



            $hotel->setPhoto($Filename);
            $entityManager->flush();

            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idhotel}", name="app_hotel_delete", methods={"POST"})
     */
    public function delete(Request $request, Hotel $hotel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotel->getIdhotel(), $request->request->get('_token'))) {
            $entityManager->remove($hotel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/", name="app_hotel_index4", methods={"POST"})
     */
    public function rechercher(Request $request)
    {
        $em = $this-> getDoctrine()->getManager();
        $hotel=$em->getRepository(Hotel::class)->findall();
        if( $request->isMethod("POST"))
        {
            $etoile =$request->get('etoile');
            $hotel =$em->getRepository("App:Hotel")->findBy(array('etoile'=>$etoile),array('nomhotel' => 'ASC'));


        }

        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotel,
        ]);
    }
 
}


