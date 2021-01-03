<?php

namespace App\Controller;

use App\Service\SerializationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     * @Method({"GET"})
     */
    public function index(EntityManagerInterface $entityManager, SerializationService $seriaServ): Response
    {

        $serialized = $seriaServ->getSerialized($entityManager);

        return new JsonResponse([
            'data' => $serialized,
            'items' => count($serialized),
        ]);
    }
}
