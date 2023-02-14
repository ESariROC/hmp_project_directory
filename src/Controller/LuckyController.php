<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class LuckyController extends AbstractController
{
    #[Route('/lucky/number')]
    public function number(): Response
    {
        $number = random_int(0, 100);
        $dagen = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag'];
        return $this->render('bezoeker/lucky.html.twig',
            ['number'=>$number,
            'days'=>$dagen
            ]);

//        return new Response(
//            '<html><body><h1>Lucky number: '.$number.'</h1></body></html>'
//        );
    }
    #[Route('goedemorgen', name: 'morgen')]
    public function goedemorgenCall(): Response
    {
        return new Response('<h1>Morge dillen </h1>');
    }
}