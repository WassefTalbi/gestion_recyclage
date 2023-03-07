<?php

namespace App\Controller;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\User;
use App\Form\UserRoleType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Doctrine\ORM\EntityManagerInterface;







#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, PaginatorInterface $paginator, Request $request): Response
    
    {
        $query = $this->getDoctrine()->getRepository(User::class)->createQueryBuilder('u');

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5 // items per page
        );
        
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'pagination' => $pagination,
        ]);
       
    }
    

#[Route('/bymail', name: 'bymail')]
    public function listUserByEmail(UserRepository $repo, Request $request)
    {

        $userByMail = $repo->orderByMail();
        

        
        return $this->render('user/listByMail.html.twig', [
            "UserByMail" => $userByMail,
        ]);
    }
    #[Route('/byusername', name: 'byusername')]
    public function listUserByUsername(UserRepository $repo, Request $request)
    {

        $userByUsername = $repo->orderByUsername();
        

        
        return $this->render('user/listByUsername.html.twig', [
            "UserByUsername" => $userByUsername,
        ]);
    }
    #[Route('/listUserVerified', name: 'listUserVerified')]
    public function listUserVerified(UserRepository $repo)
    {

        $userByVerified = $repo->findVerifiedUser();
        return $this->render('user/listUsersVerified.html.twig', [
            "UserByVerified" => $userByVerified,
        ]);
    }
    #[Route('/listUserBanned', name: 'listUserBanned')]
    public function listUserBanned(UserRepository $repo)
    {

        $userByBanned = $repo->findBannedUser();
        return $this->render('user/listUsersBanned.html.twig', [
            "UserByBanned" => $userByBanned,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/editroles/{id}', name: 'app_user_edit_roles', methods: ['GET', 'POST'])]   
    public function editUserRoles(Request $request, User $user)
    {
        $form = $this->createForm(UserRoleType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setRoles(array_unique($user->getRoles()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/edit_roles.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/{id}/ban', name: 'user_ban', methods: ['GET', 'POST'])]   
    public function ban(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('ban'.$user->getId(), $request->request->get('_token'))) {

            $user->setIsBanned(true);


            $entityManager->flush();


        }
        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/unban', name: 'user_unban', methods: ['GET', 'POST'])]   
    public function unban(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('unban'.$user->getId(), $request->request->get('_token'))) {

            $user->setIsBanned(false);


            $entityManager->flush();


        }
        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
