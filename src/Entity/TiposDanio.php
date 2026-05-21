<?php

namespace App\Entity;

use App\Repository\TiposDanioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TiposDanioRepository::class)]
class TiposDanio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?bool $magico = null;

    /**
     * @var Collection<int, Resistencias>
     */
    #[ORM\ManyToMany(targetEntity: Resistencias::class, mappedBy: 'tipoDanio')]
    private Collection $resistencias;

    /**
     * @var Collection<int, Debilidades>
     */
    #[ORM\ManyToMany(targetEntity: Debilidades::class, mappedBy: 'tipoDanio')]
    private Collection $debilidades;

    public function __construct()
    {
        $this->resistencias = new ArrayCollection();
        $this->debilidades = new ArrayCollection();
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

    public function isMagico(): ?bool
    {
        return $this->magico;
    }

    public function setMagico(bool $magico): static
    {
        $this->magico = $magico;

        return $this;
    }

    /**
     * @return Collection<int, Resistencias>
     */
    public function getResistencias(): Collection
    {
        return $this->resistencias;
    }

    public function addResistencia(Resistencias $resistencia): static
    {
        if (!$this->resistencias->contains($resistencia)) {
            $this->resistencias->add($resistencia);
            $resistencia->addTipoDanio($this);
        }

        return $this;
    }

    public function removeResistencia(Resistencias $resistencia): static
    {
        if ($this->resistencias->removeElement($resistencia)) {
            $resistencia->removeTipoDanio($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Debilidades>
     */
    public function getDebilidades(): Collection
    {
        return $this->debilidades;
    }

    public function addDebilidade(Debilidades $debilidade): static
    {
        if (!$this->debilidades->contains($debilidade)) {
            $this->debilidades->add($debilidade);
            $debilidade->addTipoDanio($this);
        }

        return $this;
    }

    public function removeDebilidade(Debilidades $debilidade): static
    {
        if ($this->debilidades->removeElement($debilidade)) {
            $debilidade->removeTipoDanio($this);
        }

        return $this;
    }
}
