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
    private Collection $ataquesJeves;

    /**
     * @var Collection<int, RasgosJefe>
     */
    #[ORM\OneToMany(targetEntity: RasgosJefe::class, mappedBy: 'jefe')]
    private Collection $rasgosJeves;

    public function __construct()
    {
        $this->ataquesJeves = new ArrayCollection();
        $this->rasgosJeves = new ArrayCollection();
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
    public function getAtaquesJeves(): Collection
    {
        return $this->ataquesJeves;
    }

    public function addAtaquesJefe(AtaquesJefe $ataquesJefe): static
    {
        if (!$this->ataquesJeves->contains($ataquesJefe)) {
            $this->ataquesJeves->add($ataquesJefe);
            $ataquesJefe->setJefe($this);
        }

        return $this;
    }

    public function removeAtaquesJefe(AtaquesJefe $ataquesJefe): static
    {
        if ($this->ataquesJeves->removeElement($ataquesJefe)) {
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
    public function getRasgosJeves(): Collection
    {
        return $this->rasgosJeves;
    }

    public function addRasgosJefe(RasgosJefe $rasgosJefe): static
    {
        if (!$this->rasgosJeves->contains($rasgosJefe)) {
            $this->rasgosJeves->add($rasgosJefe);
            $rasgosJefe->setJefe($this);
        }

        return $this;
    }

    public function removeRasgosJefe(RasgosJefe $rasgosJefe): static
    {
        if ($this->rasgosJeves->removeElement($rasgosJefe)) {
            // set the owning side to null (unless already changed)
            if ($rasgosJefe->getJefe() === $this) {
                $rasgosJefe->setJefe(null);
            }
        }

        return $this;
    }
}
