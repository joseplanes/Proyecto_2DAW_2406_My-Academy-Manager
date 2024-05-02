<?php

namespace App\Entity;

use App\Repository\MensajeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MensajeRepository::class)]
class Mensaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $remitente = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $receptor = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mensaje = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRemitente(): ?Usuario
    {
        return $this->remitente;
    }

    public function setRemitente(?Usuario $remitente): static
    {
        $this->remitente = $remitente;

        return $this;
    }

    public function getReceptor(): ?Usuario
    {
        return $this->receptor;
    }

    public function setReceptor(?Usuario $receptor): static
    {
        $this->receptor = $receptor;

        return $this;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(string $mensaje): static
    {
        $this->mensaje = $mensaje;

        return $this;
    }
}
