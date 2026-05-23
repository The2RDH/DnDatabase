<?php

namespace App\Entity;

use App\Repository\EscuelasMagiaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EscuelasMagiaRepository::class)]
class EscuelasMagia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Hechizos>
     */
    #[ORM\OneToMany(targetEntity: Hechizos::class, mappedBy: 'escuela')]
    private Collection $hechizos;

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin nombre';
    }
    
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
            $hechizo->setEscuela($this);
        }

        return $this;
    }

    public function removeHechizo(Hechizos $hechizo): static
    {
        if ($this->hechizos->removeElement($hechizo)) {
            // set the owning side to null (unless already changed)
            if ($hechizo->getEscuela() === $this) {
                $hechizo->setEscuela(null);
            }
        }

        return $this;
    }
}
