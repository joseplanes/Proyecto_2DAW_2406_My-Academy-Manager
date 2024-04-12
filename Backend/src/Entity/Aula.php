<?php

namespace App\Entity;

use App\Repository\AulaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AulaRepository::class)]
class Aula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $capacidad = null;

    #[ORM\OneToMany(targetEntity: Clase::class, mappedBy: 'aula')]
    private Collection $clases;

    public function __construct()
    {
        $this->clases = new ArrayCollection();
    }
    #[Groups(['aula'])]
    public function getId(): ?int
    {
        return $this->id;
    }
    #[Groups(['clase', 'aula'])]
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCapacidad(): ?int
    {
        return $this->capacidad;
    }

    public function setCapacidad(int $capacidad): static
    {
        $this->capacidad = $capacidad;

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
            $clase->setAula($this);
        }

        return $this;
    }

    public function removeClase(Clase $clase): static
    {
        if ($this->clases->removeElement($clase)) {
            // set the owning side to null (unless already changed)
            if ($clase->getAula() === $this) {
                $clase->setAula(null);
            }
        }

        return $this;
    }
}
