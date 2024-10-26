<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TheatrePlayRepository;
use App\Entity\TheatrePlay;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\TheatrePlayType;
use Symfony\Component\HttpFoundation\Request;
class TheatrePlayController extends AbstractController
{
    #[Route('/displayplay', name: 'app_displayplay')]
    public function displayplay(TheatrePlayRepository $repo): Response
    {
        $list=$repo->findAll();
        return $this->render('theatre_play/list.html.twig', [
            'theatre' =>$list,
        ]);
    }
    #[Route('/Update/{id}',name:'update_play')]
    public function update(ManagerRegistry $doctrine,Request $request,$id,TheatrePlayRepository $repo):response
    {
        $TheatrePlay=$repo->find($id);
        $form=$this->createForm(TheatrePlayType::class,$TheatrePlay);// creation formulaire à partir de classe authortype
        $form->handleRequest($request);//traiter les données recus 
       if ($form->isSubmitted() )//verifier  form envoyer valide 
       {
        $em=$doctrine->getManager(); // appel entity manager
        $em->flush();// d'envoyer tout ce qui a été persisté avant à la base de données
        return $this->redirectToRoute('app_displayplay');
    }
    return $this->render('theatre_play\update.html.twig',['form'=>$form->createView()]) ;
    }
    #[Route('/Delete/{id}',name:'play_delete')]
    public function DeleteTheatrePlay($id,TheatrePlayRepository $repo,ManagerRegistry $doctrine ):response
    {
        $theatre=$repo->find($id);
        $em=$doctrine->getManager();
        $em->remove($theatre);
        $em->flush();
        return $this->redirectToRoute('app_displayplay');
    }
    #[Route('/triTitle',name:'tri_title')]
    public function triTitle(TheatrePlayRepository $repo):response
    {
        $list=$repo->triPar_title();
        return $this->render('theatre_play/list.html.twig',['theatre' =>$list]);
    }
    #[Route('/triDuration',name:'tri_duration')]
    public function triDuration(TheatrePlayRepository $repo):response
    {
        $list=$repo->triPar_duration();
        return $this->render('theatre_play/list.html.twig',['theatre' =>$list]);
    }
   
    #[Route('/total_number',name:'total_number')]
    public function totalNumber(TheatrePlayRepository $repo):response
    {
        $list=$repo->TotalNumber();
        return $this->render('theatre_play/list.html.twig',['theatre' =>$list]);
    }
    
}
