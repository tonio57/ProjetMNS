<?php

namespace App\Controller;

use App\Entity\Films;
use App\Form\FilmType;
use App\Repository\SeanceRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmsController extends AbstractController
{
    /**
     * @Route("/createFilm", name="create_film")
     * @Route("/updateFilm/{id?1}", name="update_film")
     */
    public function index(Films $film = null, Request $request, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();

        $isEditor = false;
        if (!$film) {
            $film = new films;
        }

        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$film->getId()) {
                $film->setCreatedAt(new DateTimeImmutable());
            }

            $film = $form->getData();
            $entityManager->persist($film);
            $entityManager->flush();

            return $this->redirectToRoute('ListingFilms');
        }
        return $this->render("films/form.html.twig", [
            'form' => $form->createView(),
            'isEditor' => $film->getId(),
            'errors=>$errors'
        ]);
    }
    /**
     * @Route("/ListingFilms", name="ListingFilms")
     */
    public function listing(ManagerRegistry $doctrine): Response
    {
        $films = $doctrine->getManager()->getRepository(Films::class)->findAll();

        return $this->render('films/films.html.twig', ["films" => $films]);
    }
    /**
     * @Route("/{id}", name="film_show", methods={"GET"})
     */
    public function show(Films $film): Response
    {
        return $this->render('films/show.html.twig', [
            'film' => $film,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="deleteFilm")
     */
    public function delete(Films $film): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        if (isset($film)) {
            $listSeances = $film->getSeance();
            foreach ($listSeances as $Seance) {
                $entityManager->remove($Seance);
            }
            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ListingFilms');
    }

    /**
     * @Route("/film/edit/{id}")
     */
    public function update(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Film = $entityManager->getRepository(Films::class)->find($id);

        if (!$Film) {
            throw $this->createNotFoundException(
                'No Film found for id ' . $id
            );
        }

        $Film->setTitle('New Film name!');
        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $Film->getId()
        ]);
    }
}
