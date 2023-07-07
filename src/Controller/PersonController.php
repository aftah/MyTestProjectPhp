<?php

namespace App\Controller;

use App\Entity\Person;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('person')]
class PersonController extends AbstractController
{
    #[Route('/',name: 'person_list')]
    public function index(ManagerRegistry $doctrine) : Response
    {
        $repository = $doctrine->getRepository(Person::class);
        $person =  $repository->findAll();
        return $this->render('person/index.html.twig', [
            'listPerson' => $person,

            ]);
    }

    #[Route('/all/age/{ageMin}/{ageMax}',name: 'person_list_intervalAge')]
    public function intervalAge(ManagerRegistry $doctrine,$ageMin,$ageMax) : Response
    {
        $repository = $doctrine->getRepository(Person::class);
        $person =  $repository->findPersonByAgeInterval($ageMin,$ageMax);
        return $this->render('person/index.html.twig', [
            'listPerson' => $person,
        ]);
    }

    #[Route('/stat/age/{ageMin}/{ageMax}',name: 'person_stat_intervalAge')]
    public function statIntervalAge(ManagerRegistry $doctrine,$ageMin,$ageMax) : Response
    {
        $repository = $doctrine->getRepository(Person::class);
        $stat =  $repository->statPersonByAgeInterval($ageMin,$ageMax);

        return $this->render('person/stat.html.twig', [
            'statPerson' => $stat[0],
            'ageMin' => $ageMin,
            'ageMax' => $ageMax,
        ]);
    }
    #[Route('/all/{page?1}/{nbr?12}',name: 'person_all')]
    public function indexAll(ManagerRegistry $doctrine,$page,$nbr) : Response
    {
        $repository = $doctrine->getRepository(Person::class);
        $person =  $repository->findBy([],['age'=> 'DESC'],$nbr,($page - 1) * $nbr);
        $nbrTotalPerson = $repository->count([]);
        $nbrTotalPage = ceil($nbrTotalPerson / $nbr) ;

        return $this->render('person/index.html.twig', [
            'listPerson' => $person,
            'isPaginated' => true,
            'nbrTotalPage' => $nbrTotalPage,
            'page' => $page,
            'nbr' => $nbr,
        ]);
    }
    #[Route('/{id<\d+>}',name: 'person_detail')]
    public function detail(Person $person = null) : Response
    {

        if(!$person)
        {
            $this->addFlash('error',"La personne  n existe pas");
            $this->redirectToRoute('person_list');
        }

        return $this->render('person/detail.html.twig', [
            'person' => $person,
        ]);


    }
    #[Route('/add', name: 'person_add')]
    public function addPerson(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $person = new Person();
        $person->setFirstname('Abdelfetah');
        $person->setLastname('Hamra');
        $person->setAge(54);
        $person->setSex(true);

        $person1 = new Person();
        $person1->setFirstname('Moise');
        $person1->setLastname('Hamra');
        $person1->setAge(11);
        $person1->setSex(true);

        $person2 = new Person();
        $person2->setFirstname('Séverine');
        $person2->setLastname('Claes');
        $person2->setAge(48);
        $person2->setSex(true);

        $entityManager->persist($person);
        $entityManager->persist($person1);
        $entityManager->persist($person2);
        $entityManager->flush();
        return $this->render('person/detail.html.twig', [
            'person' => $person,
        ]);
    }

    #[Route('/delete/{id<\d+>}',name: 'person_delete')]
    public function deletePerson(ManagerRegistry $doctrine,Person $person = null) : RedirectResponse
    {
        if($person)
        {
            $manager = $doctrine->getManager();
            $manager->remove($person);
            $manager->flush();
            $this->addFlash('success',"La personne à été supprimé");
        }
        else
        {
            $this->addFlash('error',"La personne n existe pas");
        }

        return $this->redirectToRoute('person_all');
    }

    #[Route('/update/{id<\d+>}/{lastname}/{firstname}/{age}',name: 'person_update')]
    public function updatePerson(ManagerRegistry $doctrine,Person $person = null,$lastname,$firstname,$age) : RedirectResponse
    {

        if($person)
        {
           $person->setLastname($lastname);
           $person->setFirstname($firstname);
           $person->setAge($age);

           $manager = $doctrine->getManager();
           $manager->persist($person);
           $manager->flush();

            $this->addFlash('success',"La personne à été mise à jour");
        }
        else
        {
            $this->addFlash('error',"La personne n existe pas");
        }

        return $this->redirectToRoute('person_all');
    }
}
