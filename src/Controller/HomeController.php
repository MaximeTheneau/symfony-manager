<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/test', name: 'app_home')]
    #[Route('{page}', name: 'app_vue', requirements: ['page' => '(?!login$|register$|dashboard$).*'])]
    public function index($page = ''): Response
    {
        if ('' !== $page) {
            // Effectuer des actions spécifiques si une page est passée (par exemple, afficher un contenu dynamique basé sur 'page')
        }

        return $this->render('home/index.html.twig', [
        ]);
    }
}
