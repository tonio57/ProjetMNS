<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    /**
     *@Route("/", name="accueil")  
     */ 
     public function accueil()
     {

        return $this->render("navigation/accueil.html.twig");

     }
     /**
     *@Route("/redirect", name="redirect")  
     */ 
    public function homeRedirect()
    {
        
       return $this->redirectToRoute("accueil");

    }
     /**
     *@Route("/films", name="films")  
     */ 
    public function films()
    {
        $films=["le dictateur","les lumières de la ville", "le kid"];
       return $this->render("navigation/films.html.twig",["films"=>$films]);

    }
}