<?php

namespace App\Entity;

use App\Repository\TiposHechizoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TiposHechizoRepository::class)]
class TiposHechizo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $efecto = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Hechizos>
     */
    #[ORM\OneToMany(targetEntity: Hechizos::class, mappedBy: 'tipo')]
    private Collection $hechizos;

    public function __construct()
    {
        $this->hechizos = new ArrayCollection();
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

    public function getEfecto(): ?string
    {
        return $this->efecto;
    }

    public function setEfecto(?string $efecto): static
    {
        $this->efecto = $efecto;

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
     * @return Collection<int, Hechizos>
     */
    public function getHechizos(): Collection
    {
        return $this->hechizos;
    }

    public function addHechizo(Hechizos $hechizo): static
    {
        if (!$this->hechizos->contains($hechizo)) {
            $this->hechizos->add($hechizo);
            $hechizo->setTipo($this);
        }

        return $this;
    }

    public function removeHechizo(Hechizos $hechizo): static
    {
        if ($this->hechizos->removeElement($hechizo)) {
            // set the owning side to null (unless already changed)
            if ($hechizo->getTipo() === $this) {
                $hechizo->setTipo(null);
            }
        }

        return $this;
    }
}
