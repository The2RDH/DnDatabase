<?php

namespace App\Entity;

use App\Repository\BarajasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarajasRepository::class)]
class Barajas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $carta = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\Column]
    private ?int $copias = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $baraja = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarta(): ?string
    {
        return $this->carta;
    }

    public function setCarta(string $carta): static
    {
        $this->carta = $carta;

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

    public function getCopias(): ?int
    {
        return $this->copias;
    }

    public function setCopias(int $copias): static
    {
        $this->copias = $copias;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getBaraja(): ?string
    {
        return $this->baraja;
    }

    public function setBaraja(string $baraja): static
    {
        $this->baraja = $baraja;

        return $this;
    }
}
