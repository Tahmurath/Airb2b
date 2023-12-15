<?php

namespace App\Controller;

use App\Entity\Reserve;
use App\Repository\ReserveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
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
        //$reserves = $serializer->normalize($reserves, null, ['datetime_format' => 'Y-m-d']);
        $json = $serializer->serialize($reserves, 'json');
        return new JsonResponse(
            data:$json,
            json:true,
        );
    }

    #[Route('/reserve', name: 'app_reserve_create', methods:['POST'])]
    public function create(
        ReserveRepository $repo,
        SerializerInterface $serializer,
        Request $request
    ): JsonResponse
    {
        $reserve = $serializer->deserialize($request->getContent(), Reserve::class, 'json');
        $repo->add($reserve, true);
        //$link = $this->generateUrl('app_reserve',['id'=>$reserve->getId()]);

        return $this->json($reserve, 201);
    }

    #[Route('/reserve/{id}',name: 'app_reserve_update',methods: ['PUT'])]
    public function update(
        Reserve $reserve,
        ReserveRepository $repo,
        SerializerInterface $serializer,
        Request $request
    ): JsonResponse
    {
        $reserve = $serializer->deserialize($request->getContent(), Reserve::class, 'json', [
                AbstractNormalizer::OBJECT_TO_POPULATE => $reserve
            ]
        );

        $repo->add($reserve, true);
        return $this->json($reserve);
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
