<?php

namespace App\Controller;

use App\Entity\Reservationrestaurant;
use App\Form\ReservationrestaurantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservationrestaurant")
 */
class ReservationrestaurantController extends AbstractController
{
    /**
     * @Route("/", name="app_reservationrestaurant_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservationrestaurants = $entityManager
            ->getRepository(Reservationrestaurant::class)
            ->findAll();

        return $this->render('reservationrestaurant/index.html.twig', [
            'reservationrestaurants' => $reservationrestaurants,
        ]);
    }

    /**
     * @Route("/new", name="app_reservationrestaurant_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationrestaurant = new Reservationrestaurant();
        $form = $this->createForm(ReservationrestaurantType::class, $reservationrestaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationrestaurant);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationrestaurant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationrestaurant/new.html.twig', [
            'reservationrestaurant' => $reservationrestaurant,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("landingpage/new2", name="app_reservationrestaurant2_new", methods={"GET", "POST"})
     */
    public function new2(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationrestaurant = new Reservationrestaurant();
        $form = $this->createForm(ReservationrestaurantType::class, $reservationrestaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationrestaurant);
            $entityManager->flush();

         //   return $this->redirectToRoute('app_reservationrestaurant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationrestaurant/new2.html.twig', [
            'reservationrestaurant' => $reservationrestaurant,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{idreservationrestau}", name="app_reservationrestaurant_show", methods={"GET"})
     */
    public function show(Reservationrestaurant $reservationrestaurant): Response
    {
        return $this->render('reservationrestaurant/show.html.twig', [
            'reservationrestaurant' => $reservationrestaurant,
        ]);
    }

    /**
     * @Route("/{idreservationrestau}/edit", name="app_reservationrestaurant_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reservationrestaurant $reservationrestaurant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationrestaurantType::class, $reservationrestaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationrestaurant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationrestaurant/edit.html.twig', [
            'reservationrestaurant' => $reservationrestaurant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idreservationrestau}", name="app_reservationrestaurant_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservationrestaurant $reservationrestaurant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationrestaurant->getIdreservationrestau(), $request->request->get('_token'))) {
            $entityManager->remove($reservationrestaurant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservationrestaurant_index', [], Response::HTTP_SEE_OTHER);
    }
}
