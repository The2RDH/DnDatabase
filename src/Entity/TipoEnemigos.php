<?php

namespace App\Entity;

use App\Repository\TipoEnemigosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoEnemigosRepository::class)]
class TipoEnemigos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Enemigos>
     */
    #[ORM\ManyToMany(targetEntity: Enemigos::class, mappedBy: 'tipo')]
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
            $enemigo->addTipo($this);
        }

        return $this;
    }

    public function removeEnemigo(Enemigos $enemigo): static
    {
        if ($this->enemigos->removeElement($enemigo)) {
            $enemigo->removeTipo($this);
        }

        return $this;
    }
}
