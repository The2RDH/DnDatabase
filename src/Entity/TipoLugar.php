<?php

namespace App\Entity;

use App\Repository\TipoLugarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoLugarRepository::class)]
class TipoLugar
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
     * @var Collection<int, Lugares>
     */
    #[ORM\OneToMany(targetEntity: Lugares::class, mappedBy: 'tipoLugar')]
    private Collection $lugares;

    public function __construct()
    {
        $this->lugares = new ArrayCollection();
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
     * @return Collection<int, Lugares>
     */
    public function getLugares(): Collection
    {
        return $this->lugares;
    }

    public function addLugare(Lugares $lugare): static
    {
        if (!$this->lugares->contains($lugare)) {
            $this->lugares->add($lugare);
            $lugare->setTipoLugar($this);
        }

        return $this;
    }

    public function removeLugare(Lugares $lugare): static
    {
        if ($this->lugares->removeElement($lugare)) {
            // set the owning side to null (unless already changed)
            if ($lugare->getTipoLugar() === $this) {
                $lugare->setTipoLugar(null);
            }
        }

        return $this;
    }
}
