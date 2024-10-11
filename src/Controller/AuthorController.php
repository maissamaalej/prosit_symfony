<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
use App\Entity\Author;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\AuthorType;
use Symfony\Component\HttpFoundation\Request;
#[Route('/Author')]
class AuthorController extends AbstractController
{
    #[Route('/showAuthor/{name}', name: 'app_author')]
    public function showAuthor($name): Response
    {
        return $this->render('service/showAuthor.html.twig',['name'=>$name,]);
        
    }
    #[Route('/listAuthor', name: 'app_list')]
    public function listAuthors():Response
    {
        $authors = array( 

            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100), 
            
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200 ), 
            
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300), 
            
            ); 
            return $this->render('service/list.html.twig',['authors' => $authors ,]);
        
    }
    #[Route('/detailAuth/{id}',name:'author')]
    public function authorDetails($id):Response{
         $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200),
        array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
    );
         return $this->render('service/showAuthor.html.twig', [
                'id' => $id,'authors'=>$authors]);
                
    
    }

    #[Route('/Read',name:'app_Afficher')]
    public function afficher(AuthorRepository $repoAuthor):response
    {
        $list=$repoAuthor->findAll();
        return $this->render('author/afficher.html.twig',['authors'=>$list]);
    }
    #[Route('/Delete/{id}',name:'author_delete')]
    public function supprimer($id,AuthorRepository $repoAuthor,ManagerRegistry $doctrine ):response
    {
        $author=$repoAuthor->find($id);
        $em=$doctrine->getManager();
        $em->remove($author);
        $em->flush();
        return $this->redirectToRoute('app_Afficher');
    }
    #[Route('/Add',name:'author_add')]
    public function ajouter(ManagerRegistry $doctrine,Request $request ):response
    {
        $author=new Author(); //nouveau objet author
        /*$author->setUsername("m"); // remplir attribut usename
        $author->setEmail("m@esprit.tn");// remplir attribut email*/
        $form=$this->createForm(AuthorType::class,$author);// creation formulaire à partir de classe authortype
        $form->handleRequest($request);//traiter les données recus 
       if ($form->isSubmitted() )//verifier  form envoyer valide 
       {
        $em=$doctrine->getManager(); // appel entity manager
        $em->persist($author); // insert into
        $em->flush();// d'envoyer tout ce qui a été persisté avant à la base de données
        return $this->redirectToRoute('app_Afficher');
       }
      return $this->render('Author/add.html.twig',['form'=>$form->createView()]) ; // ou bien $this->renderForm('Author/add.html.twig',['form'=>$form]) ;
    }
    #[Route('/Update/{id}',name:'author_update')]
    public function update(ManagerRegistry $doctrine,Request $request,$id,AuthorRepository $repoAuthor):response
    {
        $author=$repoAuthor->find($id);
        $form=$this->createForm(AuthorType::class,$author);// creation formulaire à partir de classe authortype
        $form->handleRequest($request);//traiter les données recus 
       if ($form->isSubmitted() )//verifier  form envoyer valide 
       {
        $em=$doctrine->getManager(); // appel entity manager
        $em->flush();// d'envoyer tout ce qui a été persisté avant à la base de données
        return $this->redirectToRoute('app_Afficher');
    }
    return $this->render('Author/update.html.twig',['form'=>$form->createView()]) ;
    
    }






}
