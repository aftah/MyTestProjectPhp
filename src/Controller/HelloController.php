<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/sayHello/{name}', name: 'app_hello')]
    public function sayHello($name): Response
    {

        return $this->render('first/Hello.html.twig', [
            'controller_name' => 'HelloController',
            'name' => $name,
        ]);


    }
}
