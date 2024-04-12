<?php

namespace App\Entity;

use App\Repository\CalificacionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalificacionRepository::class)]
class Calificacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'calificacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clase $clase = null;

    #[ORM\ManyToOne(inversedBy: 'calificacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Alumno $alumno = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClase(): ?Clase
    {
        return $this->clase;
    }

    public function setClase(?Clase $clase): static
    {
        $this->clase = $clase;

        return $this;
    }

    public function getAlumno(): ?Alumno
    {
        return $this->alumno;
    }

    public function setAlumno(?Alumno $alumno): static
    {
        $this->alumno = $alumno;

        return $this;
    }
}
