<?php

namespace App\Entity;

use App\Repository\EspecializacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspecializacionRepository::class)]
class Especializacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'especializacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clases $clase = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'especializaci�on')]
    private ?DadosDescanso $dadosDescanso = null;

    #[ORM\ManyToOne(inversedBy: 'especializacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recursos $recurso = null;

    /**
     * @var Collection<int, Npc>
     */
    #[ORM\OneToMany(targetEntity: Npc::class, mappedBy: 'especializacion')]
    private Collection $npcs;

    /**
     * @var Collection<int, Enemigos>
     */
    #[ORM\OneToMany(targetEntity: Enemigos::class, mappedBy: 'especializacion')]
    private Collection $enemigos;

    public function __construct()
    {
        $this->npcs = new ArrayCollection();
        $this->enemigos = new ArrayCollection();
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

    public function getClase(): ?Clases
    {
        return $this->clase;
    }

    public function setClase(?Clases $clase): static
    {
        $this->clase = $clase;

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

    public function getDadosDescanso(): ?DadosDescanso
    {
        return $this->dadosDescanso;
    }

    public function setDadosDescanso(?DadosDescanso $dadosDescanso): static
    {
        $this->dadosDescanso = $dadosDescanso;

        return $this;
    }

    public function getRecurso(): ?Recursos
    {
        return $this->recurso;
    }

    public function setRecurso(?Recursos $recurso): static
    {
        $this->recurso = $recurso;

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
            $npc->setEspecializacion($this);
        }

        return $this;
    }

    public function removeNpc(Npc $npc): static
    {
        if ($this->npcs->removeElement($npc)) {
            // set the owning side to null (unless already changed)
            if ($npc->getEspecializacion() === $this) {
                $npc->setEspecializacion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Enemigos>
     */
    public function getEnemigos(): Collection
    {
        return $this->enemigos;
    }

    public function addEnemigo(Enemigos $enemigo): static
    {
        if (!$this->enemigos->contains($enemigo)) {
            $this->enemigos->add($enemigo);
            $enemigo->setEspecializacion($this);
        }

        return $this;
    }

    public function removeEnemigo(Enemigos $enemigo): static
    {
        if ($this->enemigos->removeElement($enemigo)) {
            // set the owning side to null (unless already changed)
            if ($enemigo->getEspecializacion() === $this) {
                $enemigo->setEspecializacion(null);
            }
        }

        return $this;
    }
}
