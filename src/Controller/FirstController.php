<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('first')]
class FirstController extends AbstractController
{
    #[Route('/', name: 'first')]
    public function index(): Response
    {

        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
            'path' => '       ',
        ]);


    }

    #[Route(
        '/multiplication/{e1}/{e2}',
        name: 'multiplication',
        requirements: ['e1'=> '\d+','e2'=> '\d+']
    )]
    public function Multiplication($e1,$e2) : Response
    {
        $result = $e1 * $e2;
        return new Response("<h1>$result</h1>");
    }
}
