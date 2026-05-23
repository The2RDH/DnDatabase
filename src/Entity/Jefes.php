<?php

namespace App\Entity;

use App\Repository\JefesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JefesRepository::class)]
class Jefes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'jefes')]
    private ?Razas $raza = null;

    #[ORM\ManyToOne(inversedBy: 'jefes')]
    private ?Clases $clase = null;

    #[ORM\Column]
    private ?int $nivel = null;

    #[ORM\Column]
    private ?bool $derrotado = null;

    /**
     * @var Collection<int, AtaquesJefe>
     */
    #[ORM\OneToMany(targetEntity: AtaquesJefe::class, mappedBy: 'jefe')]
    private Collection $ataquesjefes;

    /**
     * @var Collection<int, RasgosJefe>
     */
    #[ORM\OneToMany(targetEntity: RasgosJefe::class, mappedBy: 'jefe')]
    private Collection $rasgosjefes;

    #[ORM\ManyToOne(inversedBy: 'jefes')]
    private ?Especializacion $especializacion = null;

    #[ORM\ManyToOne(inversedBy: 'jefes')]
    private ?Estadisticas $estadisticas = null;

    #[ORM\Column]
    private ?bool $descubierto = null;

    #[ORM\ManyToOne(inversedBy: 'jefes')]
    private ?Estado $estado = null;

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin definir';
    }

    public function __construct()
    {
        $this->ataquesjefes = new ArrayCollection();
        $this->rasgosjefes = new ArrayCollection();
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

    public function getRaza(): ?Razas
    {
        return $this->raza;
    }

    public function setRaza(?Razas $raza): static
    {
        $this->raza = $raza;

        return $this;
    }

    public function getClase(): ?Clases
    {
        return $this->clase;
    }

    public function setClase(?Clases $clase): static
    {
        $this->clase = $clase;

        return $this;
    }

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(int $nivel): static
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function isDerrotado(): ?bool
    {
        return $this->derrotado;
    }

    public function setDerrotado(bool $derrotado): static
    {
        $this->derrotado = $derrotado;

        return $this;
    }

    /**
     * @return Collection<int, AtaquesJefe>
     */
    public function getAtaquesJefes(): Collection
    {
        return $this->ataquesjefes;
    }

    public function addAtaquesJefe(AtaquesJefe $ataquesJefe): static
    {
        if (!$this->ataquesjefes->contains($ataquesJefe)) {
            $this->ataquesjefes->add($ataquesJefe);
            $ataquesJefe->setJefe($this);
        }

        return $this;
    }

    public function removeAtaquesJefe(AtaquesJefe $ataquesJefe): static
    {
        if ($this->ataquesjefes->removeElement($ataquesJefe)) {
            // set the owning side to null (unless already changed)
            if ($ataquesJefe->getJefe() === $this) {
                $ataquesJefe->setJefe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RasgosJefe>
     */
    public function getRasgosjefes(): Collection
    {
        return $this->rasgosjefes;
    }

    public function addRasgosJefe(RasgosJefe $rasgosJefe): static
    {
        if (!$this->rasgosjefes->contains($rasgosJefe)) {
            $this->rasgosjefes->add($rasgosJefe);
            $rasgosJefe->setJefe($this);
        }

        return $this;
    }

    public function removeRasgosJefe(RasgosJefe $rasgosJefe): static
    {
        if ($this->rasgosjefes->removeElement($rasgosJefe)) {
            // set the owning side to null (unless already changed)
            if ($rasgosJefe->getJefe() === $this) {
                $rasgosJefe->setJefe(null);
            }
        }

        return $this;
    }

    public function getEspecializacion(): ?Especializacion
    {
        return $this->especializacion;
    }

    public function setEspecializacion(?Especializacion $especializacion): static
    {
        $this->especializacion = $especializacion;

        return $this;
    }

    public function getEstadisticas(): ?Estadisticas
    {
        return $this->estadisticas;
    }

    public function setEstadisticas(?Estadisticas $estadisticas): static
    {
        $this->estadisticas = $estadisticas;

        return $this;
    }

    public function isDescubierto(): ?bool
    {
        return $this->descubierto;
    }

    public function setDescubierto(bool $descubierto): static
    {
        $this->descubierto = $descubierto;

        return $this;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): static
    {
        $this->estado = $estado;

        return $this;
    }
}
