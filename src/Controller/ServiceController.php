<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ServiceController extends AbstractController
{
    #[Route('/showService/{name}', name: 'appservice')]
    public function showService($name): Response
    {
        return $this->render('service/showService.html.twig',
         ['name' => $name,
        ]);
    }
    #[Route('/go_to_index', name: 'go_to_index')]
    public function goToIndex(): Response
    {
        return $this->redirectToRoute('app_home');
    }
}

