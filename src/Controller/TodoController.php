<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todos')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'todos')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        //$todos = [];
        if(!$session-> has('todos')) {
            $todos = [
                'achat' => 'acheter cle usb',
                'cours' => 'finaliser mon cour',
                'correction' => 'Corriger mes examens',
            ];
            $session->set('todos',$todos);
            $this->addFlash('info',"La liste des todos viens d'etre initialisée");
        }



        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }

    #[Route(
        '/add/{name?horaire}/{content}',
        name: 'todos.add',
        defaults: ['content' => 'Drummy']
    )]

    public function addTodo(Request $request,$name,$content) : RedirectResponse
    {

        $session = $request->getSession();

        if($session->has('todos'))
        {
            $todos = $session->get('todos');
            if(isset($todos[$name]))
            {
                $this->addFlash('error',"Le todo d'id $name existe deja dans la liste");
            }
            else{
                $todos[$name] = $content;
                $session->set('todos',$todos);
                $this->addFlash('success',"Le todo d'id $name à été ajouté avec succès");
            }
        }
        else
        {
            $this->addFlash('error',"La liste des todos n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todos');
    }

    #[Route('/update/{name}/{content}', name: 'todos.update')]
    public function updateTodo(Request $request,$name,$content) : RedirectResponse
    {

        $session = $request->getSession();

        if($session->has('todos'))
        {
            $todos = $session->get('todos');
            if(!isset($todos[$name]))
            {
                $this->addFlash('error',"Le todo d'id $name n'existe pas dans la liste");
            }
            else{
                $todos[$name] = $content;
                $session->set('todos',$todos);
                $this->addFlash('success',"Le todo d'id $name à été modifié avec succès");
            }
        }
        else
        {
            $this->addFlash('error',"La liste des todos n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todos');
    }

    #[Route('/delete/{name}', name: 'todos.delete')]
    public function deleteTodo(Request $request,$name) : RedirectResponse
    {

        $session = $request->getSession();

        if($session->has('todos'))
        {
            $todos = $session->get('todos');
            if(!isset($todos[$name]))
            {
                $this->addFlash('error',"Le todo d'id $name n'existe pas dans la liste");
            }
            else{
                unset($todos[$name]);
                $session->set('todos',$todos);
                $this->addFlash('success',"Le todo d'id $name à été supprimé avec succès");
            }
        }
        else
        {
            $this->addFlash('error',"La liste des todos n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todos');
    }

    #[Route('/reset', name: 'todos.reset')]
    public function ResetTodo(Request $request) : RedirectResponse
    {

        $session = $request->getSession();

        $session->remove('todos');
        return $this->redirectToRoute('todos');
    }
}
