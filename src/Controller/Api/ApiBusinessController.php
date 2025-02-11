<?php

namespace App\Controller\Api;

use App\Repository\BusinessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiBusinessController extends AbstractController
{
    #[Route('/api/businesses', name: 'api_businesses', methods: ['GET'])]
    public function index(BusinessRepository $businessRepository): JsonResponse
    {
        $businesses = $businessRepository->findAll();

        $data = [];
        foreach ($businesses as $business) {
            $data[] = [
                'id' => $business->getId(),
                'name' => $business->getName(),
            ];
        }

        return new JsonResponse($data);
    }
}
