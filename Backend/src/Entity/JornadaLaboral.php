<?php

namespace App\Entity;

use App\Repository\JornadaLaboralRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: JornadaLaboralRepository::class)]
class JornadaLaboral
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'jornadaLaborals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profesor $profesor = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dia = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $Inicio = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Fin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfesor(): ?Profesor
    {
        return $this->profesor;
    }

    public function setProfesor(?Profesor $profesor): static
    {
        $this->profesor = $profesor;

        return $this;
    }
    #[Groups(['jornada'])]
    public function getDia(): ?\DateTimeInterface
    {
        return $this->dia;
    }

    public function setDia(\DateTimeInterface $dia): static
    {
        $this->dia = $dia;

        return $this;
    }
    #[Groups(['jornada'])]
    public function getInicio(): ?\DateTimeInterface
    {
        return $this->Inicio;
    }

    public function setInicio(\DateTimeInterface $Inicio): static
    {
        $this->Inicio = $Inicio;

        return $this;
    }
    #[Groups(['jornada'])]
    public function getFin(): ?\DateTimeInterface
    {
        return $this->Fin;
    }

    public function setFin(?\DateTimeInterface $Fin): static
    {
        $this->Fin = $Fin;

        return $this;
    }
}
