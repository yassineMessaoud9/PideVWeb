<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;




/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="app_evenement_indexback", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }
    /**
     * @Route("/front", name="app_evenement_index", methods={"GET"})
     */
    public function indexFront(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('evenement/indexfront.html.twig', [
            'evenements' => $evenements,
        ]);
    }
    /**
     * @Route("/sort", name="app_evenement_sort", methods={"GET"})
     */
    public function sortbyprix(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findBy(array(),array('prixeve'=>'DESC'));

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }
    /**
     * @Route("/sortPlace", name="app_evenement_place", methods={"GET"})
     */
    public function sortbyPlace(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findBy(array(),array('nbplaceeve'=>'ASC'));

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    /**
     * @Route("/new", name="app_evenement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $form->get('photoeve')->getData();
            $Filename = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_event'),
                    $Filename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }



            $evenement->setPhotoeve($Filename);
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/", name="app_recherche", methods={"GET","POST"})
     */
    public function rechercher(Request $request,EvenementRepository $repository)
    {

        if ($request->isMethod("POST")) {
            $nom = $request->get('marque');
            $evenements = $repository->findEntities($nom);
        }

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }


    /**
     * @Route("/{ideve}", name="app_evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{ideve}/edit", name="app_evenement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('photoeve')->getData();
            $Filename = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_event'),
                    $Filename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $evenement->setPhotoeve($Filename);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{ideve}", name="app_evenement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getIdeve(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }



}
