<?php

namespace App\Controller;

use App\Entity\Films;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    /**
     * @Route("/film", name="film")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager=$doctrine->getManager();
        $film=new Films;
        $film->setTitle('le dictateur');
        $film->setDirector('Charlie Chaplin');
        $entityManager->persist($film);
        $entityManager->flush();

        return new Response('Un nouveau film a été créé:'.$film->getTitle());



    }
     /**
     * @Route("/ListingFilms", name="ListingFilms")
     */
    public function listing(ManagerRegistry $doctrine): Response
    {
       $films= $doctrine->getManager()->getRepository(Films::class)->findAll();
        return $this->render("navigation/films.html.twig",["films"=>$films]);
    }
}
