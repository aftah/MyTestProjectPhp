<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HelloController extends AbstractController
{
    public function sayHello($name,$firstname): Response
    {

        return $this->render('hello/Hello.html.twig', [
            'name' => $name,
            'firstname' => $firstname,
        ]);


    }
}
