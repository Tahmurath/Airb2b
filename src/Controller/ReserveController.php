<?php

namespace App\Controller;

use App\Repository\ReserveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class ReserveController extends AbstractController
{
    #[Route('/reserve', name: 'app_reserve', methods:['GET'])]
    public function index(ReserveRepository $repo, SerializerInterface $serializer): JsonResponse
    {

        $reserves = $repo->findAll();
        $json = $serializer->serialize($reserves, 'json',);
        return new JsonResponse(
            data:$json,
            status: 200,
            json:true,
        );
    }
}
