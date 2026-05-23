<?php

namespace App\Entity;

use App\Repository\ReligionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReligionesRepository::class)]
class Religiones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deidades = null;

    /**
     * @var Collection<int, GrupoEnemigos>
     */
    #[ORM\OneToMany(targetEntity: GrupoEnemigos::class, mappedBy: 'religion')]
    private Collection $grupoEnemigos;

    public function __toString(): string
    {
        return $this->nombre ?: 'Sin definir';
    }
    
    public function __construct()
    {
        $this->grupoEnemigos = new ArrayCollection();
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

    public function getDeidades(): ?string
    {
        return $this->deidades;
    }

    public function setDeidades(?string $deidades): static
    {
        $this->deidades = $deidades;

        return $this;
    }

    /**
     * @return Collection<int, GrupoEnemigos>
     */
    public function getGrupoEnemigos(): Collection
    {
        return $this->grupoEnemigos;
    }

    public function addGrupoEnemigo(GrupoEnemigos $grupoEnemigo): static
    {
        if (!$this->grupoEnemigos->contains($grupoEnemigo)) {
            $this->grupoEnemigos->add($grupoEnemigo);
            $grupoEnemigo->setReligion($this);
        }

        return $this;
    }

    public function removeGrupoEnemigo(GrupoEnemigos $grupoEnemigo): static
    {
        if ($this->grupoEnemigos->removeElement($grupoEnemigo)) {
            // set the owning side to null (unless already changed)
            if ($grupoEnemigo->getReligion() === $this) {
                $grupoEnemigo->setReligion(null);
            }
        }

        return $this;
    }
}
