<?php

namespace App\Entity;

use App\Repository\DebilidadesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DebilidadesRepository::class)]
class Debilidades
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, TiposDanio>
     */
    #[ORM\ManyToMany(targetEntity: TiposDanio::class, inversedBy: 'debilidades')]
    private Collection $tipoDanio;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    public function __construct()
    {
        $this->tipoDanio = new ArrayCollection();
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

    /**
     * @return Collection<int, TiposDanio>
     */
    public function getTipoDanio(): Collection
    {
        return $this->tipoDanio;
    }

    public function addTipoDanio(TiposDanio $tipoDanio): static
    {
        if (!$this->tipoDanio->contains($tipoDanio)) {
            $this->tipoDanio->add($tipoDanio);
        }

        return $this;
    }

    public function removeTipoDanio(TiposDanio $tipoDanio): static
    {
        $this->tipoDanio->removeElement($tipoDanio);

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
}
