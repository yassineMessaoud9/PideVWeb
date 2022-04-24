<?php

namespace App\Controller;

use App\Entity\Agencelocation;
use App\Form\AgencelocationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/agencelocation")
 */
class AgencelocationController extends AbstractController
{
    /**
     * @Route("/", name="app_agencelocation_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager,PaginatorInterface $paginator, Request $request): Response
    {
        $agencelocations = $entityManager
            ->getRepository(Agencelocation::class)
            ->findAll();
                // Paginate the results of the query
          $allagencelocations = $paginator->paginate(
            // Doctrine Query, not results
            $agencelocations,
            // Define the page parameter
    $request->query->getInt('page', 1),
            // Items per page
            3
        );

        return $this->render('agencelocation/index.html.twig', [
            'agencelocations' => $allagencelocations,
        ]);
    }

    /**
     * @Route("/new", name="app_agencelocation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $agencelocation = new Agencelocation();
        $form = $this->createForm(AgencelocationType::class, $agencelocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($agencelocation);
            $entityManager->flush();

            return $this->redirectToRoute('app_agencelocation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('agencelocation/new.html.twig', [
            'agencelocation' => $agencelocation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idagence}", name="app_agencelocation_show", methods={"GET"})
     */
    public function show(Agencelocation $agencelocation): Response
    {
        return $this->render('agencelocation/show.html.twig', [
            'agencelocation' => $agencelocation,
        ]);
    }

    /**
     * @Route("/{idagence}/edit", name="app_agencelocation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Agencelocation $agencelocation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AgencelocationType::class, $agencelocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_agencelocation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('agencelocation/edit.html.twig', [
            'agencelocation' => $agencelocation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idagence}", name="app_agencelocation_delete", methods={"POST"})
     */
    public function delete(Request $request, Agencelocation $agencelocation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agencelocation->getIdagence(), $request->request->get('_token'))) {
            $entityManager->remove($agencelocation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_agencelocation_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/", name="app_agence_recherche", methods={"POST"})
     */
    public function rechercher(Request $request)
    {
        $em = $this-> getDoctrine()->getManager();
        $agence=$em->getRepository(Agencelocation::class)->findall();
      
        if( $request->isMethod("POST"))
        {
            $nomagence =$request->get('nomagence');
            $agence =$em->getRepository("App:Agencelocation")->findBy(array('nomagence'=>$nomagence),array('addressagence' => 'ASC'));


        }
        return $this->render('agencelocation/index.html.twig', [
            'agencelocations' => $agence,
        ]);
    }
}





