<?php

namespace App\Entity;

use App\Repository\NpcRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NpcRepository::class)]
class Npc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $altura = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $peso = null;

    #[ORM\ManyToOne(inversedBy: 'npcs')]
    private ?Razas $raza = null;

    #[ORM\ManyToOne(inversedBy: 'nivel')]
    private ?Clases $clase = null;

    #[ORM\Column(nullable: true)]
    private ?int $nivel = null;

    #[ORM\ManyToOne(inversedBy: 'npcs')]
    private ?Especializacion $especializacion = null;

    #[ORM\ManyToOne(inversedBy: 'npcs')]
    private ?Estado $estado = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\Column]
    private ?bool $descubierto = null;

    #[ORM\ManyToOne(inversedBy: 'npcs')]
    private ?Estadisticas $estadisticas = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAltura(): ?string
    {
        return $this->altura;
    }

    public function setAltura(?string $altura): static
    {
        $this->altura = $altura;

        return $this;
    }

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(?string $peso): static
    {
        $this->peso = $peso;

        return $this;
    }

    public function getRaza(): ?Razas
    {
        return $this->raza;
    }

    public function setRaza(?Razas $raza): static
    {
        $this->raza = $raza;

        return $this;
    }

    public function getClase(): ?Clases
    {
        return $this->clase;
    }

    public function setClase(?Clases $clase): static
    {
        $this->clase = $clase;

        return $this;
    }

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(?int $nivel): static
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getEspecializacion(): ?Especializacion
    {
        return $this->especializacion;
    }

    public function setEspecializacion(?Especializacion $especializacion): static
    {
        $this->especializacion = $especializacion;

        return $this;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function isDescubierto(): ?bool
    {
        return $this->descubierto;
    }

    public function setDescubierto(bool $descubierto): static
    {
        $this->descubierto = $descubierto;

        return $this;
    }

    public function getEstadisticas(): ?Estadisticas
    {
        return $this->estadisticas;
    }

    public function setEstadisticas(?Estadisticas $estadisticas): static
    {
        $this->estadisticas = $estadisticas;

        return $this;
    }
}
