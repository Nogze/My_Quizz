<?php

namespace App\Controller;

use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('user/info.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/userEdit', name: 'user_edit')]
    public function edit(Request $request, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        if ($user == null){
            return $this->redirectToRoute("app_login");
        }

        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
