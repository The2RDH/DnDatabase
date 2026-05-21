<?php

namespace App\Entity;

use App\Repository\FaccionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FaccionesRepository::class)]
class Facciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lider = null;

    #[ORM\ManyToOne(inversedBy: 'facciones')]
    private ?Jerarquias $jerarquia = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, GrupoEnemigos>
     */
    #[ORM\OneToMany(targetEntity: GrupoEnemigos::class, mappedBy: 'faccion')]
    private Collection $grupoEnemigos;

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

    public function getLider(): ?string
    {
        return $this->lider;
    }

    public function setLider(?string $lider): static
    {
        $this->lider = $lider;

        return $this;
    }

    public function getJerarquia(): ?Jerarquias
    {
        return $this->jerarquia;
    }

    public function setJerarquia(?Jerarquias $jerarquia): static
    {
        $this->jerarquia = $jerarquia;

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
            $grupoEnemigo->setFaccion($this);
        }

        return $this;
    }

    public function removeGrupoEnemigo(GrupoEnemigos $grupoEnemigo): static
    {
        if ($this->grupoEnemigos->removeElement($grupoEnemigo)) {
            // set the owning side to null (unless already changed)
            if ($grupoEnemigo->getFaccion() === $this) {
                $grupoEnemigo->setFaccion(null);
            }
        }

        return $this;
    }
}
