<?php

namespace App\Entity;

use App\Repository\LugaresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LugaresRepository::class)]
class Lugares
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'lugares')]
    private ?Regiones $region = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'lugares')]
    private ?Asentamientos $asentamiento = null;

    #[ORM\ManyToOne(inversedBy: 'lugares')]
    private ?TipoLugar $tipoLugar = null;

    #[ORM\ManyToOne(inversedBy: 'lugares')]
    private ?Terrenos $terreno = null;

    /**
     * @var Collection<int, Npc>
     */
    #[ORM\OneToMany(targetEntity: Npc::class, mappedBy: 'lugar')]
    private Collection $npcs;

    
    public function __toString(): string
    {
        return $this->nombre ?? 'Sin establecer';
    }

    public function __construct()
    {
        $this->npcs = new ArrayCollection();
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

    public function getRegion(): ?Regiones
    {
        return $this->region;
    }

    public function setRegion(?Regiones $region): static
    {
        $this->region = $region;

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

    public function getAsentamiento(): ?Asentamientos
    {
        return $this->asentamiento;
    }

    public function setAsentamiento(?Asentamientos $asentamiento): static
    {
        $this->asentamiento = $asentamiento;

        return $this;
    }

    public function getTipoLugar(): ?TipoLugar
    {
        return $this->tipoLugar;
    }

    public function setTipoLugar(?TipoLugar $tipoLugar): static
    {
        $this->tipoLugar = $tipoLugar;

        return $this;
    }

    public function getTerreno(): ?Terrenos
    {
        return $this->terreno;
    }

    public function setTerreno(?Terrenos $terreno): static
    {
        $this->terreno = $terreno;

        return $this;
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
            $npc->setLugar($this);
        }

        return $this;
    }

    public function removeNpc(Npc $npc): static
    {
        if ($this->npcs->removeElement($npc)) {
            // set the owning side to null (unless already changed)
            if ($npc->getLugar() === $this) {
                $npc->setLugar(null);
            }
        }

        return $this;
    }
}
