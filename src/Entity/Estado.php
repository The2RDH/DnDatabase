<?php

namespace App\Entity;

use App\Repository\EstadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstadoRepository::class)]
class Estado
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
     * @var Collection<int, Npc>
     */
    #[ORM\OneToMany(targetEntity: Npc::class, mappedBy: 'estado')]
    private Collection $npcs;

    /**
     * @var Collection<int, Jefes>
     */
    #[ORM\OneToMany(targetEntity: Jefes::class, mappedBy: 'estado')]
    private Collection $jefes;

    public function __construct()
    {
        $this->npcs = new ArrayCollection();
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

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin estado';
    }
    
    /**
     * @return Collection<int, Npc>
     */
    public function getNpcs(): Collection
    {
        return $this->npcs;
    }

    public function addNpc(Npc $npc): static
    {
        if (!$this->npcs->contains($npc)) {
            $this->npcs->add($npc);
            $npc->setEstado($this);
        }

        return $this;
    }

    public function removeNpc(Npc $npc): static
    {
        if ($this->npcs->removeElement($npc)) {
            // set the owning side to null (unless already changed)
            if ($npc->getEstado() === $this) {
                $npc->setEstado(null);
            }
        }

        return $this;
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
            $jefe->setEstado($this);
        }

        return $this;
    }

    public function removeJefe(Jefes $jefe): static
    {
        if ($this->jefes->removeElement($jefe)) {
            // set the owning side to null (unless already changed)
            if ($jefe->getEstado() === $this) {
                $jefe->setEstado(null);
            }
        }

        return $this;
    }
}
