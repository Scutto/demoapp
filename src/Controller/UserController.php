<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserForm;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/utenti', name: 'users.index')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/utenti/{id<\d+>}', name: 'users.show')]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/utenti/store', name: 'users.store')]
    public function store(Request $request, EntityManagerInterface $manager): Response
    {
        $user = new User;
        $form = $this->createForm(UserForm::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('users.index');
        }

        return $this->render('user/store.html.twig', [
            'form' => $form,
        ]);
    }
}
