<?php

namespace App\Entity;

use App\Repository\GrupoEnemigosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GrupoEnemigosRepository::class)]
class GrupoEnemigos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'grupoEnemigos')]
    private ?Facciones $faccion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $descubierto = null;

    #[ORM\ManyToOne(inversedBy: 'grupoEnemigos')]
    private ?Religiones $religion = null;

    /**
     * @var Collection<int, Enemigos>
     */
    #[ORM\ManyToMany(targetEntity: Enemigos::class, mappedBy: 'grupo')]
    private Collection $enemigos;

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin nombre';
    }

    public function __construct()
    {
        $this->enemigos = new ArrayCollection();
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

    public function getFaccion(): ?Facciones
    {
        return $this->faccion;
    }

    public function setFaccion(?Facciones $faccion): static
    {
        $this->faccion = $faccion;

        return $this;
    }

    public function isDescubierto(): ?bool
    {
        return $this->descubierto;
    }

    public function setDescubierto(?bool $descubierto): static
    {
        $this->descubierto = $descubierto;

        return $this;
    }

    public function getReligion(): ?Religiones
    {
        return $this->religion;
    }

    public function setReligion(?Religiones $religion): static
    {
        $this->religion = $religion;

        return $this;
    }

    /**
     * @return Collection<int, Enemigos>
     */
    public function getEnemigos(): Collection
    {
        return $this->enemigos;
    }

    public function addEnemigo(Enemigos $enemigo): static
    {
        if (!$this->enemigos->contains($enemigo)) {
            $this->enemigos->add($enemigo);
            $enemigo->addGrupo($this);
        }

        return $this;
    }

    public function removeEnemigo(Enemigos $enemigo): static
    {
        if ($this->enemigos->removeElement($enemigo)) {
            $enemigo->removeGrupo($this);
        }

        return $this;
    }
}
