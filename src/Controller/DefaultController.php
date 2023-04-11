<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('/default/login', name: 'login-default')]
    public function login(AuthenticationUtils $autenticationUttils): Response
    {
        $error = $autenticationUttils->getLastAuthenticationError();
        $lastUsername = $autenticationUttils->getLastUsername();
        return $this->render('default/login.html.twig', [
            'controller_name' => 'DefaultController', 'last_username' => $lastUsername, 'error' => $error,
        ]);
    }
    #[Route('/default/register', name: 'register-default')]
    public function register(): Response
    {
        return new Response('register-default');
    }
}
