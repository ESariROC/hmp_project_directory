<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{name}/{price}', name: 'create_product')]
    public function createProduct(ManagerRegistry $doctrine, string $name, int $price): Response
    {
        $entityManager = $doctrine->getManager();

        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    #[Route('/show/product', name: 'show_products')]
    public function showProducts(ManagerRegistry $doctrine):Response{
        $products = $doctrine->getRepository(Product::class)->findAll();
//        dd($product);
        return $this->render('product/show_product.html.twig', ['products'=>$products]);
    }
}
