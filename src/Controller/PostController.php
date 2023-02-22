<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager
            ->getRepository(Post::class)
            ->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
    

    #[Route('/front', name: 'app_post_front', methods: ['GET'])]
    public function indexf(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager
            ->getRepository(Post::class)
            ->findAll();

        return $this->render('post/indexfront.html.twig', [
            'posts' => $posts,
        ]);
    }
    

/*
    #[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $user = $entityManager
        ->getRepository(User::class)
        ->findById(54);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {*/
           
           /*   $post->setDate(new \DateTime());*/
        
           /* $post->setIdUser($user);
        


            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }*/


    #[Route('/newfront', name: 'app_post_newfront', methods: ['GET', 'POST'])]
    public function front(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadFile = $form['urlImg']->getData();
            $filename = md5(uniqid()) . '.' . $uploadFile->guessExtension(); //cryptage d image


            $uploadFile->move($this->getParameter('kernel.project_dir') . '/public/uploads', $filename);
            $post->setUrlImg($filename);
            
             $post->setDate(new \DateTime());
        
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_post_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/newfront.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }


    #[Route('/{idPost}', name: 'app_post_show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }
    #[Route('/{idPost}/front', name: 'app_post_showfront', methods: ['GET'])]
    public function showf(Post $post): Response
    {
        return $this->render('post/showfront.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/{idPost}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }
    #[Route('/{idPost}/editf', name: 'app_post_editfront', methods: ['GET', 'POST'])]
    public function editf(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_post_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/editfront.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{idPost}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getIdPost(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }
   
    #[Route('/{idPost}/f', name: 'app_post_deletef', methods: ['POST'])]
    public function deletef(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getIdPost(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_front', [], Response::HTTP_SEE_OTHER);
    }
   
    
}


