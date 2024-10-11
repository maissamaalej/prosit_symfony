<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/index/{name}', name: 'app_home')]
    public function index($name): Response
    {
        return new Response('Bonjour mes étudiants'.$name);
        
    }
}
