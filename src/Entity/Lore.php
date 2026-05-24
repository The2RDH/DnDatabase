<?php

namespace App\Entity;

use App\Repository\LoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoreRepository::class)]
class Lore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texto = null;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\ManyToMany(targetEntity: Personaje::class, inversedBy: 'lores')]
    private Collection $personaje;

    public function __construct()
    {
        $this->personaje = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(?string $texto): static
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * @return Collection<int, Personaje>
     */
    public function getPersonaje(): Collection
    {
        return $this->personaje;
    }

    public function addPersonaje(Personaje $personaje): static
    {
        if (!$this->personaje->contains($personaje)) {
            $this->personaje->add($personaje);
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): static
    {
        $this->personaje->removeElement($personaje);

        return $this;
    }
}
