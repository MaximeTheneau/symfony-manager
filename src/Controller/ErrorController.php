<?php

namespace App\Controller;

use App\Service\MetaDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class ErrorController extends AbstractController
{
    private $metaDataService;

    public function __construct(MetaDataService $metaDataService)
    {
        $this->metaDataService = $metaDataService;
    }

    #[Route('/404', name: 'app_error404')]
    public function error404(): Response
    {
        $pageData = $pageRepository->findOneBy(['slug' => '404']);

        return $this->render('front/_otter_life_presentation.html.twig', [
            'pageData' => $pageData,
        ]);
    }

    public function show(\Throwable $exception): Response
    {
        if ($exception instanceof NotFoundHttpException) {
            return $this->redirectToRoute('app_error404');
        }

        return new Response('Une erreur est survenue', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
