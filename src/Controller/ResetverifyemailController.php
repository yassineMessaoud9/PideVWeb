<?php

namespace App\Controller;

use App\Entity\Reset;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResetverifyemailController extends AbstractController
{
    /**
     * @Route("/resetverifyemail", name="app_resetverifyemail")
     */
    public function index(): Response
    {
        return $this->render('resetverifyemail/index.html.twig', [
            'controller_name' => 'ResetverifyemailController',
        ]);
    }

    /**
     * @Route("/check", name="Check")
     * Method({"GET"})
     */
    public function New(Request $request,EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        $o="";
        $rand=rand(100000,999999);
        $time=round(microtime(true) * 1000);
        $user = new Utilisateur($o);
        $form = $this->createFormBuilder($user)
            ->add('email',EmailType::class)
            ->getForm();
$res=[];
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
         
          $mail= $user->getEmail();
          if($mail!="")
          {
              if($this->getDoctrine()->getRepository(Utilisateur::class)->findBy(['email'=>$mail]))
              {
                $reset = new Reset();
                $reset->setEmail($mail);
                $reset->setCode($rand);
                $reset->setTimemils($time);
                $to=$mail;
                $sujet="Reset Password";
                $Message="Bonjour $mail Votre Code est $rand";
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($reset);
                $entityManager->flush();
                $Email = new MailerController();
                $Email->sendEmail($mailer,$to,$sujet,$Message);
                return $this->redirectToRoute('VerifyCode');
            }else{
                  echo "There is <b> no  account </b> with this email";
              }
          }
        }
        return $this->render('resetverifyemail/index.html.twig',['form'=>$form->createView()]);
    }
}
