<?php

namespace App\Entity;

use App\Repository\TipoClaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoClaseRepository::class)]
class TipoClase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $descripcion = null;

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin definir';
    }
    
    /**
     * @var Collection<int, Clases>
     */
    #[ORM\OneToMany(targetEntity: Clases::class, mappedBy: 'tipoClase')]
    private Collection $clases;

    public function __construct()
    {
        $this->clases = new ArrayCollection();
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
     * @return Collection<int, Clases>
     */
    public function getClases(): Collection
    {
        return $this->clases;
    }

    public function addClase(Clases $clase): static
    {
        if (!$this->clases->contains($clase)) {
            $this->clases->add($clase);
            $clase->setTipoClase($this);
        }

        return $this;
    }

    public function removeClase(Clases $clase): static
    {
        if ($this->clases->removeElement($clase)) {
            // set the owning side to null (unless already changed)
            if ($clase->getTipoClase() === $this) {
                $clase->setTipoClase(null);
            }
        }

        return $this;
    }
}
