<?php

namespace App\Entity;

use App\Repository\AsignaturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AsignaturaRepository::class)]
class Asignatura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $img = null;

    #[ORM\OneToMany(targetEntity: Clase::class, mappedBy: 'asignatura')]
    private Collection $clases;

    public function __construct()
    {
        $this->clases = new ArrayCollection();
    }
    
    #[Groups(['clase', 'asignaturas','clasesprofesor','clasesalumno'])]
    public function getId(): ?int
    {
        return $this->id;
    }
    #[Groups(['clase', 'asignaturas', 'alumno','clasebasic','clasesprofesor','clasesalumno','asistencia'])]
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }
    #[Groups(['clase','clasesprofesor','clasesalumno'])]
    
    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }
    #[Groups(['clase','clasesprofesor','clasesalumno'])]
    
    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    /**
     * @return Collection<int, Clase>
     */
    public function getClases(): Collection
    {
        return $this->clases;
    }

    public function addClase(Clase $clase): static
    {
        if (!$this->clases->contains($clase)) {
            $this->clases->add($clase);
            $clase->setAsignatura($this);
        }

        return $this;
    }

    public function removeClase(Clase $clase): static
    {
        if ($this->clases->removeElement($clase)) {
            // set the owning side to null (unless already changed)
            if ($clase->getAsignatura() === $this) {
                $clase->setAsignatura(null);
            }
        }

        return $this;
    }
}
