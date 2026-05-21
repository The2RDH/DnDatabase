<?php

namespace App\Entity;

use App\Repository\LugaresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LugaresRepository::class)]
class Lugares
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'lugares')]
    private ?Regiones $region = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'lugares')]
    private ?Asentamientos $asentamiento = null;

    #[ORM\ManyToOne(inversedBy: 'lugares')]
    private ?TipoLugar $tipoLugar = null;

    #[ORM\ManyToOne(inversedBy: 'lugares')]
    private ?Terrenos $terreno = null;

    public function __construct()
    {
    }

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

    public function getRegion(): ?Regiones
    {
        return $this->region;
    }

    public function setRegion(?Regiones $region): static
    {
        $this->region = $region;

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

    public function getAsentamiento(): ?Asentamientos
    {
        return $this->asentamiento;
    }

    public function setAsentamiento(?Asentamientos $asentamiento): static
    {
        $this->asentamiento = $asentamiento;

        return $this;
    }

    public function getTipoLugar(): ?TipoLugar
    {
        return $this->tipoLugar;
    }

    public function setTipoLugar(?TipoLugar $tipoLugar): static
    {
        $this->tipoLugar = $tipoLugar;

        return $this;
    }

    public function getTerreno(): ?Terrenos
    {
        return $this->terreno;
    }

    public function setTerreno(?Terrenos $terreno): static
    {
        $this->terreno = $terreno;

        return $this;
    }
}
