<?php

namespace App\Entity;

use App\Repository\AlumnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AlumnoRepository::class)]
class Alumno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'alumnos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\ManyToMany(targetEntity: Clase::class, mappedBy: 'alumnos')]
    private Collection $clases;

    #[ORM\OneToMany(targetEntity: Calificacion::class, mappedBy: 'alumno')]
    private Collection $calificacions;

    /**
     * @var Collection<int, Asistencia>
     */
    #[ORM\OneToMany(targetEntity: Asistencia::class, mappedBy: 'alumno')]
    private Collection $asistencias;

    public function __construct()
    {
        $this->clases = new ArrayCollection();
        $this->calificacions = new ArrayCollection();
        $this->asistencias = new ArrayCollection();
    }
    #[Groups(['clase', 'alumno','clasesprofesor'])]
    public function getId(): ?int
    {
        return $this->id;
    }
    #[Groups(['clase', 'alumno', 'clasesprofesor'])]
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection<int, Clase>
     */
    #[Groups(['alumno', 'clasesalumno'])]
    public function getClases(): Collection
    {
        return $this->clases;
    }

    public function addClase(Clase $clase): static
    {
        if (!$this->clases->contains($clase)) {
            $this->clases->add($clase);
            $clase->addAlumno($this);
        }

        return $this;
    }

    public function removeClase(Clase $clase): static
    {
        if ($this->clases->removeElement($clase)) {
            $clase->removeAlumno($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Calificacion>
     */
    #[Groups(['notas'])]
    public function getCalificacions(): Collection
    {
        return $this->calificacions;
    }

    public function addCalificacion(Calificacion $calificacion): static
    {
        if (!$this->calificacions->contains($calificacion)) {
            $this->calificacions->add($calificacion);
            $calificacion->setAlumno($this);
        }

        return $this;
    }

    public function removeCalificacion(Calificacion $calificacion): static
    {
        if ($this->calificacions->removeElement($calificacion)) {
            // set the owning side to null (unless already changed)
            if ($calificacion->getAlumno() === $this) {
                $calificacion->setAlumno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Asistencia>
     */
    #[Groups(['asistencia'])]
    public function getAsistencias(): Collection
    {
        return $this->asistencias;
    }

    public function addAsistencia(Asistencia $asistencia): static
    {
        if (!$this->asistencias->contains($asistencia)) {
            $this->asistencias->add($asistencia);
            $asistencia->setAlumno($this);
        }

        return $this;
    }

    public function removeAsistencia(Asistencia $asistencia): static
    {
        if ($this->asistencias->removeElement($asistencia)) {
            // set the owning side to null (unless already changed)
            if ($asistencia->getAlumno() === $this) {
                $asistencia->setAlumno(null);
            }
        }

        return $this;
    }
}
