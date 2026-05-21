<?php

namespace App\Entity;

use App\Repository\EnemigosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnemigosRepository::class)]
class Enemigos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, TipoEnemigos>
     */
    #[ORM\ManyToMany(targetEntity: TipoEnemigos::class, inversedBy: 'enemigos')]
    private Collection $tipo;

    /**
     * @var Collection<int, GrupoEnemigos>
     */
    #[ORM\ManyToMany(targetEntity: GrupoEnemigos::class, inversedBy: 'enemigos')]
    private Collection $grupo;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    /**
     * @var Collection<int, Razas>
     */
    #[ORM\ManyToMany(targetEntity: Razas::class, inversedBy: 'enemigos')]
    private Collection $raza;

    #[ORM\ManyToOne(inversedBy: 'enemigos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clases $clase = null;

    #[ORM\ManyToOne(inversedBy: 'enemigos')]
    private ?Especializacion $especializacion = null;

    #[ORM\Column]
    private ?bool $descubierto = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nivel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    public function __toString(): string
    {
        return $this->getNombre() ?? 'Nuevo Enemigo';
    }

    public function __construct()
    {
        $this->tipo = new ArrayCollection();
        $this->grupo = new ArrayCollection();
        $this->raza = new ArrayCollection();
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

    /**
     * @return Collection<int, TipoEnemigos>
     */
    public function getTipo(): Collection
    {
        return $this->tipo;
    }

    public function addTipo(TipoEnemigos $tipo): static
    {
        if (!$this->tipo->contains($tipo)) {
            $this->tipo->add($tipo);
        }

        return $this;
    }

    public function removeTipo(TipoEnemigos $tipo): static
    {
        $this->tipo->removeElement($tipo);

        return $this;
    }

    /**
     * @return Collection<int, GrupoEnemigos>
     */
    public function getGrupo(): Collection
    {
        return $this->grupo;
    }

    public function addGrupo(GrupoEnemigos $grupo): static
    {
        if (!$this->grupo->contains($grupo)) {
            $this->grupo->add($grupo);
        }

        return $this;
    }

    public function removeGrupo(GrupoEnemigos $grupo): static
    {
        $this->grupo->removeElement($grupo);

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): static
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return Collection<int, Razas>
     */
    public function getRazas(): Collection
    {
        return $this->raza;
    }

    public function getRaza(): Collection
    {
        return $this->raza;
    }

    public function addRazas(Razas $raza): static
    {
        if (!$this->raza->contains($raza)) {
            $this->raza->add($raza);
        }

        return $this;
    }

    public function removeRazas(Razas $raza): static
    {
        $this->raza->removeElement($raza);

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

    public function getEspecializacion(): ?Especializacion
    {
        return $this->especializacion;
    }

    public function setEspecializacion(?Especializacion $especializacion): static
    {
        $this->especializacion = $especializacion;

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

    public function getNivel(): ?string
    {
        return $this->nivel;
    }

    public function setNivel(?string $nivel): static
    {
        $this->nivel = $nivel;

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
}
