<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/Register", name="app_registerClient")
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $userPasswordEncoder,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
        $rol = 'Client';

        $user = new Utilisateur($rol);
        $to = $user->getEmail();
        $subj = 'Inscription chez Trip To Do';
        $msj = ' Welcome ' . $user->getNom() . 'Sur Trip To Do';
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $file = $form->get('photo')->getData();
            $Filename = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('images'), $Filename);
            } catch (FileException $e) {
            }

            $user->setPhoto($Filename);

            $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            //    $email = new MailerController();
            //     $email->sendEmail($mailer,$to,$subj,$msj);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/RegisterAdmin", name="app_Admin")
     */
    public function registerAdmin(
        Request $request,
        UserPasswordEncoderInterface $userPasswordEncoder,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
        $rol = 'Admin';
        $user = new Utilisateur($rol);

        $subj = 'Inscription chez Trip To Do';
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('photo')->getData();
            $Filename = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('images'), $Filename);
            } catch (FileException $e) {
            }

            $user->setPhoto($Filename);
            $to = $form->getData()->getEmail();
            $msj = ' Welcome ' . $form->getData()->getNom() . 'Sur Trip To Do';

            $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();

            // $email = new MailerController();
            // $email->sendEmail($mailer,$to,$subj,$msj);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
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
