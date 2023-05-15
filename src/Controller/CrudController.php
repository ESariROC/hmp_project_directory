<?php

namespace App\Controller;

use App\Entity\Autos;
use App\Form\InsertType;
use App\Form\UpdateType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrudController extends AbstractController
{
    #[Route('/crud', name: 'app_crud')]
    public function index(): Response
    {
        return $this->render('crud/index.html.twig', ['controller_name' => 'CrudController'],
        );
    }

    #[Route('/crud/home', name: 'app_crud')]
    public function showHome(ManagerRegistry $doctrine): Response
    {
        $autos = $doctrine->getRepository(Autos::class)->findAll();
        return $this->render('crud/home.html.twig', ['autos'=>$autos],
        );
    }
    #[Route('/crud/details/{id}', name: 'details')]
    public function showDetails(ManagerRegistry $doctrine, int $id): Response
    {
        $autos = $doctrine->getRepository(Autos::class)->find($id);
        return $this->render('crud/detail.html.twig', ['autos'=>$autos],
        );
    }
    #[Route('/crud/update/{id}', name: 'update')]
    public function update(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $autos = $entityManager->getRepository(Autos::class)->find($id);

        $form = $this->createForm(UpdateType::class, $autos);


        $form->handleRequest($request);
        // dd($form);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $entityManager->flush();

            // ... perform some action, such as saving the task to the database
            return $this->redirectToRoute('app_crud', ['id' => $autos->getId()]);
        }
        return $this->render('crud/update.html.twig', ['form' => $form,]);
    }
    #[Route('/crud/delete/{id}', name: 'delete')]
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();

        $autos = $entityManager->getRepository(Autos::class)->find($id);





            $entityManager->remove($autos);
            $entityManager->flush();
            // ... perform some action, such as saving the task to the database
            return $this->redirectToRoute('app_crud', ['id' => $autos->getId()]);

    }
    #[Route('/crud/insert', name: 'insert')]
    public function insert(Request $request, ManagerRegistry $doctrine): Response
    {
        $task = new Autos();
        $form = $this->createForm(InsertType::class, $task);


        $form->handleRequest($request);
        // dd($form);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            //dd($task);
            $entityManager->persist($task);

            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your row was added!');

            // ... perform some action, such as saving the task to the database
            return $this->redirectToRoute('app_crud');


        }
        return $this->render('crud/insert.html.twig', ['form' => $form,]);
    }
}
