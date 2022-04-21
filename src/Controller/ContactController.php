<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request ,\Swift_Mailer  $mailer)
    {

        $form=$this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $contact=$form->getData();

            $message=(new \Swift_Message('Nouveau contact'))
                ->setFrom($contact['email'])

                ->setTo('yassine.ayadi2@esprit.tn')
                ->setBody(
                    $this->renderView('emails/emails.html.twig',compact('contact')),
                    'text/html'

                );

            $mailer->send($message);
            $this->addFlash('message','Votre message a été bien enovyé');

            return $this->redirectToRoute('app_contact');
        }
        return $this->render('contact/index.html.twig', [
            'contactform' => $form->createView()
        ]);
    }
}
