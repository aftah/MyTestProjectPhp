<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableauController extends AbstractController
{
    #[Route('/tableau/{nb<\d+>?5}', name: 'tableau')]
    public function index($nb): Response
    {
        $notes = [];
        for($i = 0 ; $i<$nb ; $i++)
        {
            $notes[] = rand(0,20);
        }
        return $this->render('tableau/index.html.twig', [
            'controller_name' => 'TableauController',
            'notes' => $notes,
        ]);
    }

    #[Route('/tableau/users', name: 'users')]
    public function users(): Response
    {
        $users = [
            ['firstName'=> 'Aftah', 'lastName' => 'Hamra', 'age' => '54'],
            ['firstName'=> 'Moise', 'lastName' => 'Hamra', 'age' => '11'],
            ['firstName'=> 'Severine', 'lastName' => 'Claes', 'age' => '48'],
        ];
        return $this->render('tableau/users.html.twig',[
            'controller_name' => 'users',
            'users' => $users,
        ]);
    }
}
