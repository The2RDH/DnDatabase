<?php

namespace App\Entity;

use App\Repository\BarajasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarajasRepository::class)]
class Barajas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, CartasBaraja>
     */
    #[ORM\OneToMany(targetEntity: CartasBaraja::class, mappedBy: 'baraja')]
    private Collection $cartasBarajas;

    public function __toString(): string
    {
        return $this->nombre ?: 'Nueva Baraja';
    }
    
    public function __construct()
    {
        $this->cartasBarajas = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, CartasBaraja>
     */
    public function getCartasBarajas(): Collection
    {
        return $this->cartasBarajas;
    }

    public function addCartasBaraja(CartasBaraja $cartasBaraja): static
    {
        if (!$this->cartasBarajas->contains($cartasBaraja)) {
            $this->cartasBarajas->add($cartasBaraja);
            $cartasBaraja->setBaraja($this);
        }

        return $this;
    }

    public function removeCartasBaraja(CartasBaraja $cartasBaraja): static
    {
        if ($this->cartasBarajas->removeElement($cartasBaraja)) {
            // set the owning side to null (unless already changed)
            if ($cartasBaraja->getBaraja() === $this) {
                $cartasBaraja->setBaraja(null);
            }
        }

        return $this;
    }
}
