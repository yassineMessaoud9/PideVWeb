<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Twilio\Rest\Client;


/**
 * @Route("/reclamation")
 */
class ReclamationController extends AbstractController
{
    /**
     * @Route("/", name="app_reclamation_indexback", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }
    /**
     * @Route("/front", name="app_reclamation_index", methods={"GET"})
     */
    public function index2(EntityManagerInterface $entityManager): Response
    {
        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();

        return $this->render('reclamation/indexfront.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }
    /**
     * @Route("/new", name="app_reclamation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {
            $rr = $this->filterwords($reclamation->getDescription());

                var_dump("************");
                $reclamation->setDescription($rr);
                $entityManager->persist($reclamation);
                $entityManager->flush();


                    $sid    = "AC7caedd3a6b9c25ac6b692e7e107ad122";
                    $token  = "5baef8f953a0d6d9c7a4cfa7300a05f0";
                    $twilio = new Client($sid, $token);

                    $message = $twilio->messages
                        ->create("+21656788559", // to
                            array(
                                'from' => "+13042444539",
                                "body" => "Reclamation envoyé aves sucées"
                            )
                        );

                    print($message->sid);

                return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/print" , name="print")
     */
    public function Print(EntityManagerInterface $entityManager):Response
    {
        $pdfoptions=new Options();

        $pdfoptions->set('defaultFont','Arial');
        $pdfoptions->setIsRemoteEnabled(true);
        $pdfoptions->set('isHtml5ParserEnabled',true);
        $pdfoptions->set('isRemoteEnabled',true);
        $dompdf= new Dompdf($pdfoptions);
        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();
        $html=$this->renderView('reclamation/pdfprint.html.twig',[
            'reclamations'=>$reclamations
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');

        $dompdf->render();
        //$dompdf->stream("yassinepdf.pdf", ["Attachment"=>true]);
        $dompdf->stream("yassinepdf.pdf", ["Attachment"=>false]);

    }

    /**
     * @Route("/{idreclamation}", name="app_reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{idreclamation}/edit", name="app_reclamation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{idreclamation}/editA", name="app_reclamation_editAdmin", methods={"GET", "POST"})
     */
    public function editAdmin(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/editAdmin.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{idreclamation}", name="app_reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdreclamation(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }

    public function filterwords($text)
    {
        $filterWords = array('fokalaomok', 'bhim', 'msatek', 'fuck', 'slut', 'fucku', 'mofo');
        $filterCount = count($filterWords);
        $str = "";
        $data = preg_split('/\s+/',  $text);
        foreach($data as $s){
            $g = false;
            foreach ($filterWords as $lib) {
                if($s == $lib){
                    $t = "";
                    for($i =0; $i<strlen($s); $i++) $t .= "*";
                    $str .= $t . " ";
                    $g = true;
                    break;
                }
            }
            if(!$g)
            $str .= $s . " ";
        }
        return $str;
    }

}
