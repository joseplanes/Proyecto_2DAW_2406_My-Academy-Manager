<?php

namespace App\Entity;

use App\Repository\DiasSemanaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DiasSemanaRepository::class)]
class DiasSemana
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $dia = null;

    #[ORM\ManyToMany(targetEntity: Clase::class, mappedBy: 'dias')]
    private Collection $clases;

    public function __construct()
    {
        $this->clases = new ArrayCollection();
    }
    #[Groups(['clase', 'dias','clasesprofesor','clasesalumno'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['dias','clasesprofesor','clasesalumno'])]
    public function getDia(): ?string
    {
        return $this->dia;
    }

    public function setDia(string $dia): static
    {
        $this->dia = $dia;

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
            $clase->addDia($this);
        }

        return $this;
    }

    public function removeClase(Clase $clase): static
    {
        if ($this->clases->removeElement($clase)) {
            $clase->removeDia($this);
        }

        return $this;
    }
}
