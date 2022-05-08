<?php

namespace App\Controller;

use App\Entity\Agencelocation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class MobileController extends AbstractController
{
   

    /**
     * @Route("/agencelocationmobile", name="app_agencelocation_mobile")
     */
    public function home()
    {
        $evenements = $this->getDoctrine()
            ->getRepository(Agencelocation::class)
            ->findAll();
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = [$normalizer];
        $serializer = new Serializer($normalizers, $encoders);
        $formatted = $serializer->normalize($evenements);
        return new JsonResponse($formatted);

    }

    /**
     * @Route("/AjouteAgence/", name="app_ajout_mobileajout", methods={"POST"})
     */
    public function Ajoute(Request $request)
    {
        try {
            $agencelocation = new Agencelocation();

            $agencelocation->setNomagence($request->get('nomagence'));
            $agencelocation->setContactagence($request->get('contactagence'));
            $agencelocation->setAddressagence($request->get('addressagence'));   
            $agencelocation->setLogoagence($request->get('logoagence'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($agencelocation);
            $em->flush();
            $encoders = [new XmlEncoder(), new JsonEncoder()];
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = [$normalizer];
            $serializer = new Serializer($normalizers, $encoders);
            $formatted = $serializer->normalize($agencelocation);
            return new JsonResponse($formatted);
        } catch (Exception $e) {
            echo 'Exception reçue : ', $e->getMessage(), "\n";
        }
    }

      /**
     *@Route("/test/{idagence}", name="display_agenceid" )
     */
    public function allRecActionbyid (NormalizerInterface $Normalizer ,Request $request, $idagence){
        $em=$this->getDoctrine ()->getManager ();
        $rec=$em->getRepository( Agencelocation::class)->find($idagence);
        $jsonC=$Normalizer->normalize($rec,'json',['groups'=>'post:read']);
        return new JsonResponse($jsonC);

    }
}
