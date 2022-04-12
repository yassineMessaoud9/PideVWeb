<?php

namespace App\Controller;

use App\Entity\Reset;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckCodeController extends AbstractController
{
    /**
     * @Route("/checkcode", name="app_check_code")
     */
    public function index(): Response
    {
        return $this->render('check_code/index.html.twig', [
            'controller_name' => 'CheckCodeController',
        ]);
    }

    /**
     * @Route("/VerifyCode", name="VerifyCode")
     * Method({"GET"})
     */
    public function New(Request $request,EntityManagerInterface $entityManager)
    {
        $reset = new Reset();
        $time=round(microtime(true) * 1000);
        $form = $this->createFormBuilder($reset)
            ->add('code',TextType::class)
            ->getForm();
$res=[];
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
         
          $resetC= $reset->getCode();
          if($resetC!="")
          {
              $cc=$this->getDoctrine()->getRepository(Reset::class)->findOneBy(['code'=>$resetC]);
              if($cc)
              {
               

               $oo=$cc->getTimemils();
               $NewT=$time-$oo;
               if($NewT<90000000)
               {
                    return $this->redirectToRoute('Reset',['email'=>$cc->getEmail()]);
               }else{
                   echo ' Time passed';
               }
            }else{
                  echo "This Code doesn't exist";
              }
          }
        }
        return $this->render('check_code/index.html.twig',['form'=>$form->createView()]);
    }
}
