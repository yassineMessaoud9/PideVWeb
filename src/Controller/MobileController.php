<?php

namespace App\Controller;

use App\Entity\Compagnieaerienne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MobileController extends AbstractController
{
   /**
     * @Route("/Compagnieaeriennemobile", name="app_Compagnieaerienne_mobile")
     */
    public function home()
    {
        $evenements = $this->getDoctrine()
            ->getRepository(Compagnieaerienne::class)
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
}
