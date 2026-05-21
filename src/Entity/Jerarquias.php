<?php

namespace App\Entity;

use App\Repository\JerarquiasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JerarquiasRepository::class)]
class Jerarquias
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Facciones>
     */
    #[ORM\OneToMany(targetEntity: Facciones::class, mappedBy: 'jerarquia')]
    private Collection $facciones;

    public function __construct()
    {
        $this->facciones = new ArrayCollection();
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
     * @return Collection<int, Facciones>
     */
    public function getFacciones(): Collection
    {
        return $this->facciones;
    }

    public function addFaccione(Facciones $faccione): static
    {
        if (!$this->facciones->contains($faccione)) {
            $this->facciones->add($faccione);
            $faccione->setJerarquia($this);
        }

        return $this;
    }

    public function removeFaccione(Facciones $faccione): static
    {
        if ($this->facciones->removeElement($faccione)) {
            // set the owning side to null (unless already changed)
            if ($faccione->getJerarquia() === $this) {
                $faccione->setJerarquia(null);
            }
        }

        return $this;
    }
}
