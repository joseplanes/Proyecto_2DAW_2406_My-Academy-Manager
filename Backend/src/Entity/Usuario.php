<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_nacimiento = null;

    #[ORM\Column(length: 255)]
    private ?string $rol = null;

    #[ORM\OneToMany(targetEntity: Profesor::class, mappedBy: 'usuario')]
    private Collection $profesors;

    #[ORM\OneToMany(targetEntity: Alumno::class, mappedBy: 'usuario')]
    private Collection $alumnos;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dni = null;

    /**
     * @var Collection<int, Mensaje>
     */
    #[ORM\OneToMany(targetEntity: Mensaje::class, mappedBy: 'remitente')]
    private Collection $mensajes;

    public function __construct()
    {
        $this->profesors = new ArrayCollection();
        $this->alumnos = new ArrayCollection();
        $this->mensajes = new ArrayCollection();
    }
    #[Groups(['usuario','clasesprofesor','mensaje'])]
    public function getId(): ?int
    {
        return $this->id;
    }
    #[Groups(['clase', 'usuario', 'profesor','clasesprofesor','mensaje'])]
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }
    #[Groups(['clase', 'usuario', 'profesor','clasesprofesor','mensaje'])]
    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

        return $this;
    }
    #[Groups(['clase', 'usuario'])]
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fecha_nacimiento): static
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }
    #[Groups(['usuario','clase'])]
    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(string $rol): static
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * @return Collection<int, Profesor>
     */
    public function getProfesors(): Collection
    {
        return $this->profesors;
    }

    public function addProfesor(Profesor $profesor): static
    {
        if (!$this->profesors->contains($profesor)) {
            $this->profesors->add($profesor);
            $profesor->setUsuario($this);
        }

        return $this;
    }

    public function removeProfesor(Profesor $profesor): static
    {
        if ($this->profesors->removeElement($profesor)) {
            // set the owning side to null (unless already changed)
            if ($profesor->getUsuario() === $this) {
                $profesor->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Alumno>
     */
    public function getAlumnos(): Collection
    {
        return $this->alumnos;
    }

    public function addAlumno(Alumno $alumno): static
    {
        if (!$this->alumnos->contains($alumno)) {
            $this->alumnos->add($alumno);
            $alumno->setUsuario($this);
        }

        return $this;
    }

    public function removeAlumno(Alumno $alumno): static
    {
        if ($this->alumnos->removeElement($alumno)) {
            // set the owning side to null (unless already changed)
            if ($alumno->getUsuario() === $this) {
                $alumno->setUsuario(null);
            }
        }

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): static
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * @return Collection<int, Mensaje>
     */
    public function getMensajes(): Collection
    {
        return $this->mensajes;
    }

    public function addMensaje(Mensaje $mensaje): static
    {
        if (!$this->mensajes->contains($mensaje)) {
            $this->mensajes->add($mensaje);
            $mensaje->setRemitente($this);
        }

        return $this;
    }

    public function removeMensaje(Mensaje $mensaje): static
    {
        if ($this->mensajes->removeElement($mensaje)) {
            // set the owning side to null (unless already changed)
            if ($mensaje->getRemitente() === $this) {
                $mensaje->setRemitente(null);
            }
        }

        return $this;
    }
}
