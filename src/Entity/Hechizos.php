<?php

namespace App\Entity;

use App\Repository\HechizosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HechizosRepository::class)]
class Hechizos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $coste = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $costeExtra = null;

    #[ORM\Column]
    private ?bool $canalizado = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $efectos = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?bool $verbal = null;

    #[ORM\Column]
    private ?bool $somatico = null;

    #[ORM\Column]
    private ?bool $material = null;

    #[ORM\ManyToOne(inversedBy: 'hechizos')]
    private ?TiposHechizo $tipo = null;

    #[ORM\ManyToOne(inversedBy: 'hechizos')]
    private ?EscuelasMagia $escuela = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $duracion = null;

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

    public function getCoste(): ?int
    {
        return $this->coste;
    }

    public function setCoste(int $coste): static
    {
        $this->coste = $coste;

        return $this;
    }

    public function getCosteExtra(): ?string
    {
        return $this->costeExtra;
    }

    public function setCosteExtra(?string $costeExtra): static
    {
        $this->costeExtra = $costeExtra;

        return $this;
    }

    public function isCanalizado(): ?bool
    {
        return $this->canalizado;
    }

    public function setCanalizado(bool $canalizado): static
    {
        $this->canalizado = $canalizado;

        return $this;
    }

    public function getEfectos(): ?string
    {
        return $this->efectos;
    }

    public function setEfectos(?string $efectos): static
    {
        $this->efectos = $efectos;

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

    public function isVerbal(): ?bool
    {
        return $this->verbal;
    }

    public function setVerbal(bool $verbal): static
    {
        $this->verbal = $verbal;

        return $this;
    }

    public function isSomatico(): ?bool
    {
        return $this->somatico;
    }

    public function setSomatico(bool $somatico): static
    {
        $this->somatico = $somatico;

        return $this;
    }

    public function isMaterial(): ?bool
    {
        return $this->material;
    }

    public function setMaterial(bool $material): static
    {
        $this->material = $material;

        return $this;
    }

    public function getTipo(): ?TiposHechizo
    {
        return $this->tipo;
    }

    public function setTipo(?TiposHechizo $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getEscuela(): ?EscuelasMagia
    {
        return $this->escuela;
    }

    public function setEscuela(?EscuelasMagia $escuela): static
    {
        $this->escuela = $escuela;

        return $this;
    }

    public function getDuracion(): ?string
    {
        return $this->duracion;
    }

    public function setDuracion(?string $duracion): static
    {
        $this->duracion = $duracion;

        return $this;
    }
}
