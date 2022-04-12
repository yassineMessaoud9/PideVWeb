<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ModifierMdpController extends AbstractController
{
    /**
     * @Route("/Resett", name="app_modifier_mdp")
     */
    public function index(): Response
    {
        return $this->render('modifier_mdp/index.html.twig', [
            'controller_name' => 'ModifierMdpController',
        ]);
    }

    /**
     * @Route("/Reset", name="Reset")
     * Method({"GET"})
     */
    public function New(
        Request $request,
        UtilisateurRepository $URe,
        UserPasswordEncoderInterface $userPasswordEncoder,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ) {
        $o = '';
        $Varmail = $_GET['email'];

        $user = new Utilisateur($o);
        $form = $this->createFormBuilder($user)
            ->add('password', PasswordType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $to = $Varmail;
            $sujet = 'Password Changed';
            $Message = "Bonjour $Varmail Votre email est changé !";
            $pass = $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $URe->updateU($pass, $Varmail);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $Mai = new MailerController();
            $Mai->sendEmail($mailer, $to, $sujet, $Message);
        }
        return $this->render('modifier_mdp/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
