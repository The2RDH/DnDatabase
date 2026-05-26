<?php

namespace App\Entity;

use App\Repository\AlineamientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlineamientoRepository::class)]
class Alineamiento
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
     * @var Collection<int, Deidades>
     */
    #[ORM\OneToMany(targetEntity: Deidades::class, mappedBy: 'alineamiento')]
    private Collection $deidades;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\OneToMany(targetEntity: Personaje::class, mappedBy: 'alineamiento')]
    private Collection $personajes;

    /**
     * @var Collection<int, Jefes>
     */
    #[ORM\OneToMany(targetEntity: Jefes::class, mappedBy: 'alineamiento')]
    private Collection $jefes;


    public function __construct()
    {
        $this->deidades = new ArrayCollection();
        $this->personajes = new ArrayCollection();
        $this->jefes = new ArrayCollection();
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
     * @return Collection<int, Deidades>
     */
    public function getDeidades(): Collection
    {
        return $this->deidades;
    }

    public function addDeidade(Deidades $deidade): static
    {
        if (!$this->deidades->contains($deidade)) {
            $this->deidades->add($deidade);
            $deidade->setAlineamiento($this);
        }

        return $this;
    }

    public function removeDeidade(Deidades $deidade): static
    {
        if ($this->deidades->removeElement($deidade)) {
            // set the owning side to null (unless already changed)
            if ($deidade->getAlineamiento() === $this) {
                $deidade->setAlineamiento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Personaje>
     */
    public function getPersonajes(): Collection
    {
        return $this->personajes;
    }

    public function addPersonaje(Personaje $personaje): static
    {
        if (!$this->personajes->contains($personaje)) {
            $this->personajes->add($personaje);
            $personaje->setAlineamiento($this);
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): static
    {
        if ($this->personajes->removeElement($personaje)) {
            // set the owning side to null (unless already changed)
            if ($personaje->getAlineamiento() === $this) {
                $personaje->setAlineamiento(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin Alineamiento';
    }

    /**
     * @return Collection<int, Jefes>
     */
    public function getJefes(): Collection
    {
        return $this->jefes;
    }

    public function addJefe(Jefes $jefe): static
    {
        if (!$this->jefes->contains($jefe)) {
            $this->jefes->add($jefe);
            $jefe->setAlineamiento($this);
        }

        return $this;
    }

    public function removeJefe(Jefes $jefe): static
    {
        if ($this->jefes->removeElement($jefe)) {
            // set the owning side to null (unless already changed)
            if ($jefe->getAlineamiento() === $this) {
                $jefe->setAlineamiento(null);
            }
        }

        return $this;
    }
}
