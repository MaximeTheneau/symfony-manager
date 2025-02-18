<?php

namespace App\Controller;

use App\Service\MetaDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    private $metaDataService;

    public function __construct(MetaDataService $metaDataService)
    {
        $this->metaDataService = $metaDataService;
    }

    #[Route('{page}', name: 'app_vue', requirements: ['page' => '(?!login$|register$|dashboard$).*'])]
    public function index($page = ''): Response
    {
        if ('' !== $page) {
            // Effectuer des actions spécifiques si une page est passée (par exemple, afficher un contenu dynamique basé sur 'page')
        }

        $title = 'Page Title for '.$page;
        $description = 'Description for the '.$page.' page.';
        $url = 'https://www.monsite.com/'.$page;

        $metaTags = $this->metaDataService->generateMetaTags($title, $description, $url, $url);

        return $this->render('home/index.html.twig', [
            'metaTags' => $metaTags,
        ]);
    }
}
