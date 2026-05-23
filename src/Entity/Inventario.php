<?php

namespace App\Entity;

use App\Repository\InventarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InventarioRepository::class)]
class Inventario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'inventarios')]
    private ?Objetos $objeto = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidad = null;

    #[ORM\ManyToOne(inversedBy: 'inventarios')]
    private ?Personaje $personaje = null;

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

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPersonaje(): ?Personaje
    {
        return $this->personaje;
    }

    public function setPersonaje(?Personaje $personaje): static
    {
        $this->personaje = $personaje;

        return $this;
    }
}
