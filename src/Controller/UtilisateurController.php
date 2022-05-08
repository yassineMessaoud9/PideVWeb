<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/DashboardAdmin", name="app_utilisateur_index", methods={"GET"})
     */
    public function index(
        UtilisateurRepository $utilisateurRepository
    ): Response {
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurRepository->findAll(),
        ]);
    }

    /**
     * @param PostRepository $utilisateurRepository
     * @return JsonResponse
     * @Route("/DashboardAdminMobile", name="app_utilisateur_indexM", methods={"GET"})
     */
    public function indexMobile(
        UtilisateurRepository $utilisateurRepository
    ): Response {
        $data = $utilisateurRepository->findAll();
        return $this->response($data);
    }
    /**
     * @Route("/new", name="app_utilisateur_new", methods={"GET", "POST"})
     */
    public function new(
        Request $request,
        UtilisateurRepository $utilisateurRepository
    ): Response {
        $o = 'Admin';
        $utilisateur = new Utilisateur($o);
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurRepository->add($utilisateur);
            return $this->redirectToRoute(
                'app_utilisateur_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("utilisateur/{id}/desactiver", name="desactiver-user")
     */
    public function desactiverUser($id)
    {
        $user = $this->getDoctrine()
            ->getRepository(utilisateur::class)
            ->find($id);
        $user->setActivated('Desactive');
        $user->setRoles(['BLOQ']);
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("utilisateur/{id}/activer", name="activer-user")
     */
    public function activerUser($id)
    {
        $user = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->find($id);
        $user->setIsVerified(1);
        $user->setRoles(['Admin']);
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('admin');
    }
    /**
     * @Route("/{id}", name="app_utilisateur_show", methods={"GET"})
     */
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_utilisateur_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Utilisateur $utilisateur,
        UtilisateurRepository $utilisateurRepository
    ): Response {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurRepository->add($utilisateur);
            return $this->redirectToRoute(
                'app_utilisateur_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_utilisateur_delete", methods={"POST"})
     */
    public function delete(
        Request $request,
        Utilisateur $utilisateur,
        UtilisateurRepository $utilisateurRepository
    ): Response {
        if (
            $this->isCsrfTokenValid(
                'delete' . $utilisateur->getId(),
                $request->request->get('_token')
            )
        ) {
            $utilisateurRepository->remove($utilisateur);
        }

        return $this->redirectToRoute(
            'app_utilisateur_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }

    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, $status = 200, $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }

    protected function transformJsonBody(
        \Symfony\Component\HttpFoundation\Request $request
    ) {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}
