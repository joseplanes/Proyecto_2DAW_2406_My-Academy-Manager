<?php

namespace App\Entity;

use App\Repository\ProfesorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProfesorRepository::class)]
class Profesor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'profesors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\OneToMany(targetEntity: Clase::class, mappedBy: 'profesor')]
    private Collection $clases;

    /**
     * @var Collection<int, JornadaLaboral>
     */
    #[ORM\OneToMany(targetEntity: JornadaLaboral::class, mappedBy: 'profesor')]
    private Collection $jornadaLaborals;

    public function __construct()
    {
        $this->clases = new ArrayCollection();
        $this->jornadaLaborals = new ArrayCollection();
    }
    #[Groups(['clase', 'profesor'])]
    public function getId(): ?int
    {
        return $this->id;
    }
    #[Groups(['clase', 'profesor'])]
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
    #[Groups(['clasesprofesor'])]
    public function getClases(): Collection
    {
        return $this->clases;
    }

    public function addClase(Clase $clase): static
    {
        if (!$this->clases->contains($clase)) {
            $this->clases->add($clase);
            $clase->setProfesor($this);
        }

        return $this;
    }

    public function removeClase(Clase $clase): static
    {
        if ($this->clases->removeElement($clase)) {
            // set the owning side to null (unless already changed)
            if ($clase->getProfesor() === $this) {
                $clase->setProfesor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, JornadaLaboral>
     */
    public function getJornadaLaborals(): Collection
    {
        return $this->jornadaLaborals;
    }

    public function addJornadaLaboral(JornadaLaboral $jornadaLaboral): static
    {
        if (!$this->jornadaLaborals->contains($jornadaLaboral)) {
            $this->jornadaLaborals->add($jornadaLaboral);
            $jornadaLaboral->setProfesor($this);
        }

        return $this;
    }

    public function removeJornadaLaboral(JornadaLaboral $jornadaLaboral): static
    {
        if ($this->jornadaLaborals->removeElement($jornadaLaboral)) {
            // set the owning side to null (unless already changed)
            if ($jornadaLaboral->getProfesor() === $this) {
                $jornadaLaboral->setProfesor(null);
            }
        }

        return $this;
    }
}
