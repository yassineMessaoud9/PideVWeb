<?php

namespace App\Controller;

use App\Entity\Reservationhotels;
use App\Form\ReservationhotelsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservationhotels")
 */
class ReservationhotelsController extends AbstractController
{
    /**
     * @Route("/", name="app_reservationhotels_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservationhotels = $entityManager
            ->getRepository(Reservationhotels::class)
            ->findAll();

        return $this->render('reservationhotels/index.html.twig', [
            'reservationhotels' => $reservationhotels,
        ]);
    }
    
    /**
     * @Route("/landingpage", name="app_reservationhotels2_index", methods={"GET"})
     */
    public function index3(EntityManagerInterface $entityManager): Response
    {
        $reservationhotels = $entityManager
            ->getRepository(Reservationhotels::class)
            ->findAll();

        return $this->render('reservationhotels/show2.html.twig', [
            'reservationhotels' => $reservationhotels,
        ]);
    }
   

    /**
     * @Route("/new", name="app_reservationhotels_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationhotel = new Reservationhotels();
        $form = $this->createForm(ReservationhotelsType::class, $reservationhotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationhotel);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationhotels_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationhotels/new.html.twig', [
            'reservationhotel' => $reservationhotel,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("landingpage/new2", name="app_reservationhotels2_new", methods={"GET", "POST"})
     */
    public function new2(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationhotel = new Reservationhotels();
        $form = $this->createForm(ReservationhotelsType::class, $reservationhotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationhotel);
            $entityManager->flush();

           // return $this->redirectToRoute('app_reservationhotels2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationhotels/new2.html.twig', [
            'reservationhotel' => $reservationhotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idreservationhotel}", name="app_reservationhotels_show", methods={"GET"})
     */
    public function show(Reservationhotels $reservationhotel): Response
    {
        return $this->render('reservationhotels/show.html.twig', [
            'reservationhotel' => $reservationhotel,
        ]);
    }

    /**
     * @Route("/{idreservationhotel}/edit", name="app_reservationhotels_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reservationhotels $reservationhotel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationhotelsType::class, $reservationhotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationhotels_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationhotels/edit.html.twig', [
            'reservationhotel' => $reservationhotel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idreservationhotel}", name="app_reservationhotels_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservationhotels $reservationhotel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationhotel->getIdreservationhotel(), $request->request->get('_token'))) {
            $entityManager->remove($reservationhotel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservationhotels_index', [], Response::HTTP_SEE_OTHER);
    }
}
