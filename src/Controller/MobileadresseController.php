<?php

namespace App\Controller;


use App\Entity\Adresse;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MobileadresseController extends AbstractController
{
   /**
     * @Route("/Adressemobile", name="app_Adresse_mobile")
     */
    public function home()
    {
        $evenements = $this->getDoctrine()
            ->getRepository(Adresse::class)
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
     * @Route("/AjouteAdresse/", name="app_ajoutadresse_mobileajout", methods={"POST"})
     */
    public function Ajoute(Request $request)
    {
        try {
            $plat = new Adresse();

            $plat->setPaysadresse($request->get('paysadresse'));
            $plat->setRueadresse($request->get('rueadresse'));
            $plat->setContactadresse($request->get('contactadresse'));
            

            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();
            $encoders = [new XmlEncoder(), new JsonEncoder()];
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = [$normalizer];
            $serializer = new Serializer($normalizers, $encoders);
            $formatted = $serializer->normalize($plat);
            return new JsonResponse($formatted);
        } catch (Exception $e) {
            echo 'Exception reçue : ', $e->getMessage(), "\n";
        }
    }
}

