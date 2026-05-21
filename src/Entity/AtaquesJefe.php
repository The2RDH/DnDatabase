<?php

namespace App\Entity;

use App\Repository\AtaquesJefeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtaquesJefeRepository::class)]
class AtaquesJefe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $recarga = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $objetivos = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $daño = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $salvacion = null;

    #[ORM\ManyToOne(inversedBy: 'ataquesJeves')]
    private ?Jefes $jefe = null;

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

    public function getRecarga(): ?string
    {
        return $this->recarga;
    }

    public function setRecarga(?string $recarga): static
    {
        $this->recarga = $recarga;

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

    public function getObjetivos(): ?string
    {
        return $this->objetivos;
    }

    public function setObjetivos(?string $objetivos): static
    {
        $this->objetivos = $objetivos;

        return $this;
    }

    public function getDaño(): ?string
    {
        return $this->daño;
    }

    public function setDaño(?string $daño): static
    {
        $this->daño = $daño;

        return $this;
    }

    public function getSalvacion(): ?string
    {
        return $this->salvacion;
    }

    public function setSalvacion(?string $salvacion): static
    {
        $this->salvacion = $salvacion;

        return $this;
    }

    public function getJefe(): ?Jefes
    {
        return $this->jefe;
    }

    public function setJefe(?Jefes $jefe): static
    {
        $this->jefe = $jefe;

        return $this;
    }
}
