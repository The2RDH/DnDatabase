<?php

namespace App\Entity;

use App\Repository\TipoObjetoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoObjetoRepository::class)]
class TipoObjeto
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
     * @var Collection<int, Objetos>
     */
    #[ORM\OneToMany(targetEntity: Objetos::class, mappedBy: 'tipoObjeto')]
    private Collection $objetos;

    public function __construct()
    {
        $this->objetos = new ArrayCollection();
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
     * @return Collection<int, Objetos>
     */
    public function getObjetos(): Collection
    {
        return $this->objetos;
    }

    public function addObjeto(Objetos $objeto): static
    {
        if (!$this->objetos->contains($objeto)) {
            $this->objetos->add($objeto);
            $objeto->setTipoObjeto($this);
        }

        return $this;
    }

    public function removeObjeto(Objetos $objeto): static
    {
        if ($this->objetos->removeElement($objeto)) {
            // set the owning side to null (unless already changed)
            if ($objeto->getTipoObjeto() === $this) {
                $objeto->setTipoObjeto(null);
            }
        }

        return $this;
    }
}
