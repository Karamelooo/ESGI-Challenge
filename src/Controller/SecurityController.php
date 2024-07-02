<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserFormType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/user/delete/{id}', name: 'app_user.delete', methods: ['DELETE'])]
    public function delete(User $user, EntityManagerInterface $em): Response
    {
        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'Utilisateur supprimé');
        return $this->redirectToRoute('dashboard');
    }

    #[Route(path: '/user/edit/{id}', name: 'app_user.edit', methods: ['GET', 'POST'])]
    public function edit(User $user): Response
    {
        $form = $this->createForm(EditUserFormType::class, $user);
        return $this->render('security/edit.html.twig', [
            'user' => $user,
            'form' => $form
        ]);
    }

    #[Route(path: '/user/{id}', name: 'app_user.show', methods: ['GET', 'POST'])]
    public function show(User $user): Response
    {
        return $this->render('security/show.html.twig', [
            'user' => $user
        ]);
    }

    #[Route(path: '/users', name: 'app_user.show_all')]
    public function show_all(UserRepository $repository): Response
    {
        $users = $repository->findAll();
        return $this->render('security/show_all.html.twig', [
            'users' => $users
        ]);
    }
}
