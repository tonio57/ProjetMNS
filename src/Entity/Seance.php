<?php

namespace App\Entity;

use DateTime;
use App\Entity\Films;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SeanceRepository;

/**
 * @ORM\Entity(repositoryClass=SeanceRepository::class)
 */
class Seance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $langue;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $CreateAt;


    /**
     * @ORM\ManyToOne(targetEntity=Films::class, inversedBy="seance")
     */
    private $films;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="seances")
     */
    private $salle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->CreateAt;
    }

    public function setCreateAt(\DateTimeImmutable $CreateAt): self
    {
        $this->CreateAt = $CreateAt;

        return $this;
    }

    public function getFilms(): ?Films
    {
        return $this->films;
    }

    public function setFilms(?Films $films): self
    {
        $this->films = $films;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

}
