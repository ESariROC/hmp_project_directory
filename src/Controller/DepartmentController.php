<?php

namespace App\Controller;

use App\Form\DepartmentType;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{
    #[Route('/department', name: 'app_department')]
    public function index(): Response
    {
        return $this->render('department/index.html.twig', [
            'controller_name' => 'DepartmentController',
        ]);
    }
    #[Route('/department/home', name: 'app_departmenthome')]
    public function showHome(Request $request): Response
    {
        $department= new Department();
        $form=$this->createForm(DepartmentType::class, $department);

        return $this->render('department/home.html.twig', [
            'controller_name' => 'DepartmentController',
        ]);
    }
}
