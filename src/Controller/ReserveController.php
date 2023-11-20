<?php

namespace App\Controller;

use App\Repository\ReserveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReserveController extends AbstractController
{
    #[Route('/reserve', name: 'app_reserve')]
    public function index(ReserveRepository $repo): Response
    {
        return $this->json($repo->findAll());
//        return $this->render('reserve/index.html.twig', [
//            'controller_name' => 'ReserveController',
//        ]);
    }
}
