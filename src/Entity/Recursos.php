<?php

namespace App\Entity;

use App\Repository\RecursosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecursosRepository::class)]
class Recursos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $obtencion = null;

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin definir';
    }
    /**
     * @var Collection<int, Clases>
     */
    #[ORM\OneToMany(targetEntity: Clases::class, mappedBy: 'recurso')]
    private Collection $clases;

    /**
     * @var Collection<int, Estadisticas>
     */
    #[ORM\OneToMany(targetEntity: Estadisticas::class, mappedBy: 'recurso')]
    private Collection $estadisticas;

    /**
     * @var Collection<int, Especializacion>
     */
    #[ORM\OneToMany(targetEntity: Especializacion::class, mappedBy: 'recurso', orphanRemoval: true)]
    private Collection $especializacions;

    public function __construct()
    {
        $this->clases = new ArrayCollection();
        $this->estadisticas = new ArrayCollection();
        $this->especializacions = new ArrayCollection();
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

    public function getObtencion(): ?string
    {
        return $this->obtencion;
    }

    public function setObtencion(?string $obtencion): static
    {
        $this->obtencion = $obtencion;

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
            $clase->setRecurso($this);
        }

        return $this;
    }

    public function removeClase(Clases $clase): static
    {
        if ($this->clases->removeElement($clase)) {
            // set the owning side to null (unless already changed)
            if ($clase->getRecurso() === $this) {
                $clase->setRecurso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Estadisticas>
     */
    public function getEstadisticas(): Collection
    {
        return $this->estadisticas;
    }

    public function addEstadistica(Estadisticas $estadistica): static
    {
        if (!$this->estadisticas->contains($estadistica)) {
            $this->estadisticas->add($estadistica);
            $estadistica->setRecurso($this);
        }

        return $this;
    }

    public function removeEstadistica(Estadisticas $estadistica): static
    {
        if ($this->estadisticas->removeElement($estadistica)) {
            // set the owning side to null (unless already changed)
            if ($estadistica->getRecurso() === $this) {
                $estadistica->setRecurso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Especializacion>
     */
    public function getEspecializacions(): Collection
    {
        return $this->especializacions;
    }

    public function addEspecializacion(Especializacion $especializacion): static
    {
        if (!$this->especializacions->contains($especializacion)) {
            $this->especializacions->add($especializacion);
            $especializacion->setRecurso($this);
        }

        return $this;
    }

    public function removeEspecializacion(Especializacion $especializacion): static
    {
        if ($this->especializacions->removeElement($especializacion)) {
            // set the owning side to null (unless already changed)
            if ($especializacion->getRecurso() === $this) {
                $especializacion->setRecurso(null);
            }
        }

        return $this;
    }
}
