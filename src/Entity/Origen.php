<?php

namespace App\Entity;

use App\Repository\OrigenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrigenRepository::class)]
class Origen
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
     * @var Collection<int, Razas>
     */
    #[ORM\OneToMany(targetEntity: Razas::class, mappedBy: 'origen')]
    private Collection $razas;

    /**
     * @var Collection<int, Idiomas>
     */
    #[ORM\OneToMany(targetEntity: Idiomas::class, mappedBy: 'origen')]
    private Collection $idiomas;

    public function __toString(): string
    {
        return $this->nombre ?? 'Desconocido/Sin Origen';
    }

    public function __construct()
    {
        $this->razas = new ArrayCollection();
        $this->idiomas = new ArrayCollection();
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
     * @return Collection<int, Razas>
     */
    public function getRazas(): Collection
    {
        return $this->razas;
    }

    public function addRaza(Razas $raza): static
    {
        if (!$this->razas->contains($raza)) {
            $this->razas->add($raza);
            $raza->setOrigen($this);
        }

        return $this;
    }

    public function removeRaza(Razas $raza): static
    {
        if ($this->razas->removeElement($raza)) {
            // set the owning side to null (unless already changed)
            if ($raza->getOrigen() === $this) {
                $raza->setOrigen(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Idiomas>
     */
    public function getIdiomas(): Collection
    {
        return $this->idiomas;
    }

    public function addIdioma(Idiomas $idioma): static
    {
        if (!$this->idiomas->contains($idioma)) {
            $this->idiomas->add($idioma);
            $idioma->setOrigen($this);
        }

        return $this;
    }

    public function removeIdioma(Idiomas $idioma): static
    {
        if ($this->idiomas->removeElement($idioma)) {
            // set the owning side to null (unless already changed)
            if ($idioma->getOrigen() === $this) {
                $idioma->setOrigen(null);
            }
        }

        return $this;
    }
}
