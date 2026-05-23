<?php

namespace App\Entity;

use App\Repository\ObjetosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjetosRepository::class)]
class Objetos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'objetos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rarezas $rareza = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $valor = null;

    #[ORM\Column(nullable: true)]
    private ?float $peso = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?bool $consumible = null;

    #[ORM\ManyToOne(inversedBy: 'objetos')]
    #[ORM\JoinColumn(name: "tipo_objeto_id", referencedColumnName: "id")]
    private ?TipoObjeto $tipoObjetos = null;

    /**
     * @var Collection<int, Inventario>
     */
    #[ORM\OneToMany(targetEntity: Inventario::class, mappedBy: 'objeto')]
    private Collection $inventarios;

    /**
     * @var Collection<int, OfertaComercial>
     */
    #[ORM\OneToMany(targetEntity: OfertaComercial::class, mappedBy: 'objeto')]
    private Collection $ofertaComercials;

    public function __toString(): string
    {
        return $this->nombre ?: 'Nuevo Objeto';
    }

    public function __construct()
    {
        $this->inventarios = new ArrayCollection();
        $this->ofertaComercials = new ArrayCollection();
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

    public function getRareza(): ?Rarezas
    {
        return $this->rareza;
    }

    public function setRareza(?Rarezas $rareza): static
    {
        $this->rareza = $rareza;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(?string $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(?float $peso): static
    {
        $this->peso = $peso;

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

    public function isConsumible(): ?bool
    {
        return $this->consumible;
    }

    public function setConsumible(bool $consumible): static
    {
        $this->consumible = $consumible;

        return $this;
    }

    public function gettipoObjetos(): ?TipoObjeto
    {
        return $this->tipoObjetos;
    }

    public function settipoObjetos(?TipoObjeto $tipoObjetos): static
    {
        $this->tipoObjetos = $tipoObjetos;

        return $this;
    }

    /**
     * @return Collection<int, Inventario>
     */
    public function getInventarios(): Collection
    {
        return $this->inventarios;
    }

    public function addInventario(Inventario $inventario): static
    {
        if (!$this->inventarios->contains($inventario)) {
            $this->inventarios->add($inventario);
            $inventario->setObjeto($this);
        }

        return $this;
    }

    public function removeInventario(Inventario $inventario): static
    {
        if ($this->inventarios->removeElement($inventario)) {
            // set the owning side to null (unless already changed)
            if ($inventario->getObjeto() === $this) {
                $inventario->setObjeto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OfertaComercial>
     */
    public function getOfertaComercials(): Collection
    {
        return $this->ofertaComercials;
    }

    public function addOfertaComercial(OfertaComercial $ofertaComercial): static
    {
        if (!$this->ofertaComercials->contains($ofertaComercial)) {
            $this->ofertaComercials->add($ofertaComercial);
            $ofertaComercial->setObjeto($this);
        }

        return $this;
    }

    public function removeOfertaComercial(OfertaComercial $ofertaComercial): static
    {
        if ($this->ofertaComercials->removeElement($ofertaComercial)) {
            // set the owning side to null (unless already changed)
            if ($ofertaComercial->getObjeto() === $this) {
                $ofertaComercial->setObjeto(null);
            }
        }

        return $this;
    }
}
