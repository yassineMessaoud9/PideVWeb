<?php

namespace App\Controller;

use App\Entity\Reservationvol;
use App\Form\ReservationvolType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationvol = new Reservationvol();
        $form = $this->createForm(ReservationvolType::class, $reservationvol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationvol);
            $entityManager->flush();

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
    public function new2(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationvol = new Reservationvol();
        $form = $this->createForm(ReservationvolType::class, $reservationvol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationvol);
            $entityManager->flush();

           // return $this->redirectToRoute('app_reservationvol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationvol/new2.html.twig', [
            'reservationvol' => $reservationvol,
            'form' => $form->createView(),
        ]);
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
}
