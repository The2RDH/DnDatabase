<?php

namespace App\Entity;

use App\Repository\OfertaComercialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfertaComercialRepository::class)]
class OfertaComercial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ofertaComercials')]
    private ?Objetos $objeto = null;

    #[ORM\Column]
    private ?float $precio = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjeto(): ?Objetos
    {
        return $this->objeto;
    }

    public function setObjeto(?Objetos $objeto): static
    {
        $this->objeto = $objeto;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}
