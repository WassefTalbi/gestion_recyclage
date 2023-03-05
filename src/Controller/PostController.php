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
use App\Repository\PostRepository;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/post')]
class PostController extends AbstractController
{




    
    /**
     * @Route("/registerPost", name="registerPost")
     */
    public function registerPost( Request $request,SerializerInterface $serializer,EntityManagerInterface $manager){
        $Post = new Post();

        $Post->setDescription($request->query->get("description"));
        //$Post->setDate($request->query->get("date"));
        $Post->setUrlImg($request->query->get("urlImg"));
        $Post->setTitre($request->query->get("titre"));
        $Post->setActive($request->query->get("active"));
        $manager->persist($Post);
        $manager->flush();
        $json=$serializer->serialize($Post,'json',['groups'=>'Post']);
        return new Response($json);
    }



    

/**
     * @Route("/postlist",name="Postlist")
     */

     public function getPosts(PostRepository $repo,SerializerInterface $serializer )
     {
        $posts = $repo->findAll();

        $json=$serializer->serialize($posts,'json', ['groups' => 'Post']);
        return new Response($json);
    }


    /**
     * @Route("/postlist/{id}",name="post")
     */
    public function StudentId($id, NormalizerInterface $normalizer, PostRepository $repo)
    {
        $post = $repo->find($id);
        $PostNormalises = $normalizer->normalize($post, 'json', ['groups' => "Post"]);
        return new Response(json_encode($PostNormalises));
    }



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
    

    #[Route('/front', name: 'app_post_front', methods: ['GET','POST'])]
    public function indexf(EntityManagerInterface $entityManager,Request $request,PostRepository $postRepository): Response
    {
        $posts = $entityManager
            ->getRepository(Post::class)
            ->findAll();
            /////////
            $back = null;
            
            if($request->isMethod("POST")){
                if ( $request->request->get('optionsRadios')){
                    $SortKey = $request->request->get('optionsRadios');
                    switch ($SortKey){
                        case 'titre':
                            $posts = $postRepository->SortBytitre();
                            break;
    
                        case 'description':
                            $posts = $postRepository->SortByTdescription();
                            break;

                        case 'date':
                            $posts = $postRepository->SortByDate();
                            break;
    
    
                    }
                }
                else
                {
                    $type = $request->request->get('optionsearch');
                    $value = $request->request->get('Search');
                    switch ($type){
                        case 'titre':
                            $posts = $postRepository->findBytitre($value);
                            break;
    
                        case 'description':
                            $posts = $postRepository->findBydescription($value);
                            break;
    
                        case 'date':
                            $posts = $postRepository->findByDate($value);
                            break;
    
    
                    }
                }

                if ( $posts){
                    $back = "success";
                }else{
                    $back = "failure";
                }
            }
                //

        return $this->render('post/indexfront.html.twig', [
            'posts' => $posts,'back'=>$back,
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
   
    


   /**
     * @Route("/updatePost", name="updatePost")
     */
    public function updatePost(
        Request $request,
        serializerInterface $serializer,
        EntityManagerInterface $entityManager)
        {
    $Post = new Post();
    $Post=$this->getDoctrine()->getRepository(Post::class)->findOneBy(array('id'=>$request->query->get("id")));

    $Post->setDescription($request->query->get("description"));
        //$Post->setDate($request->query->get("date"));
        $Post->setUrlImg($request->query->get("urlImg"));
        $Post->setTitre($request->query->get("titre"));
        $Post->setActive($request->query->get("active"));
$entityManager->persist($Post);
$entityManager->flush();

 return new Response("success");

}

/**
* @Route("/deletepoost", name="deleteuaer")
*/
public function deletepoost(
        Request $request,
        serializerInterface $serializer,
        EntityManagerInterface $entityManager

){

    $Post=$this->getDoctrine()->getRepository(Post::class)->findOneBy(array('id'=>$request->query->get("id")));
    $em=$this->getDoctrine()->getManager();
    $em->remove($Post);
    $em->flush();
    return new Response("success");

}



}




