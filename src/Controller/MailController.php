<?php

namespace App\Controller;

use App\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MailController extends AbstractController
{
    /**
     * @Route("/mail", name="app_mail")
     */
    public function index(Request $request ,\Swift_Mailer  $mailer)
    {
        $form=$this->createForm(MailType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $contact=$form->getData();

           $message=(new \Swift_Message('Nouveau contact'))
                ->setFrom($contact['email'])

                ->setTo('omar.fitouri@esprit.tn')
                ->setBody(
                    $this->renderView('E-mail/Email.html.twig',compact('contact')),
                    'text/html'

                );

            $mailer->send($message);
            $this->addFlash('message','Votre message a été bien envoyé');

            return $this->redirectToRoute('app_mail');
        }





        return $this->render('mail/index.html.twig', [
            'controller_name' =>$form->createView() ,
        ]);
    }
}
