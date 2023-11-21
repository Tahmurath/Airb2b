<?php

namespace App\Controller;

use App\Entity\Reserve;
use App\Repository\ReserveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class ReserveController extends AbstractController
{
    #[Route('/reserve', name: 'app_reserve', methods:['GET'])]
    public function index(
        ReserveRepository $repo,
        SerializerInterface $serializer
    ): JsonResponse
    {

        $reserves = $repo->findAll();
        $json = $serializer->serialize($reserves, 'json',);
        return new JsonResponse(
            data:$json,
            status: 200,
            json:true,
        );
    }

    #[Route('/reserve/{id}', name: 'app_reserve_item', methods:['GET'])]
    public function view(
        Reserve $reserve
    ): JsonResponse
    {
        return $this->json($reserve);
    }

    #[Route('/reserve/{id}', name: 'app_reserve_delete', methods:['DELETE'])]
    public function delete(
        ReserveRepository $repo,
        Reserve $reserve
    ): JsonResponse
    {
        $repo->remove($reserve, true);
        return $this->json('', 204);
    }

}
