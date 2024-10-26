<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ShowRepository;
use App\Entity\Show;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ShowType;
use Symfony\Component\HttpFoundation\Request;
class ShowController extends AbstractController
{
    #[Route('/displayshow', name: 'app_displayshow')]
    public function displayshow(ShowRepository $repo): Response
    {
        $list=$repo->findAll();
        return $this->render('show/list.html.twig', [
            'show' =>$list]);
    }
    #[Route('/Add',name:'show_add')]
    public function ajoutershow(ManagerRegistry $doctrine,Request $request ):response
    {
        $s=new Show(); 
        $form=$this->createForm(ShowType::class,$s);
        $form->handleRequest($request);
       if ($form->isSubmitted() )
       {
        $em=$doctrine->getManager(); 
        $em->persist($s); 
        $em->flush();
        return $this->redirectToRoute('app_displayshow');
       }
      return $this->render('show/add.html.twig',['form'=>$form->createView()]) ;
    }
}
