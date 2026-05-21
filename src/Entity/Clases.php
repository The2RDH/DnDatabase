<?php

namespace App\Entity;

use App\Repository\ClasesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasesRepository::class)]
class Clases
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'clases')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TipoClase $tipoClase = null;

    #[ORM\ManyToOne(inversedBy: 'clases')]
    private ?Recursos $recurso = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    /**
     * @var Collection<int, Especializacion>
     */
    #[ORM\OneToMany(targetEntity: Especializacion::class, mappedBy: 'clase', orphanRemoval: true)]
    private Collection $especializacions;


    /**
     * @var Collection<int, Jefes>
     */
    #[ORM\OneToMany(targetEntity: Jefes::class, mappedBy: 'clase')]
    private Collection $jefes;

    /**
     * @var Collection<int, Npc>
     */
    #[ORM\OneToMany(targetEntity: Npc::class, mappedBy: 'clase')]
    private Collection $nivel;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\OneToMany(targetEntity: Personaje::class, mappedBy: 'clase')]
    private Collection $personajes;

    /**
     * @var Collection<int, Enemigos>
     */
    #[ORM\OneToMany(targetEntity: Enemigos::class, mappedBy: 'clase')]
    private Collection $enemigos;

    public function __construct()
    {
        $this->especializacions = new ArrayCollection();
        $this->jefes = new ArrayCollection();
        $this->nivel = new ArrayCollection();
        $this->personajes = new ArrayCollection();
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

    public function getTipoClase(): ?TipoClase
    {
        return $this->tipoClase;
    }

    public function setTipoClase(?TipoClase $tipoClase): static
    {
        $this->tipoClase = $tipoClase;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

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
     * @return Collection<int, Especializacion>
     */
    public function getEspecializacions(): Collection
    {
        return $this->especializacions;
    }

    public function addEspecializacion(Especializacion $especializacion): static
    {
        if (!$this->especializacions->contains($especializacion)) {
            $this->especializacions->add($especializacion);
            $especializacion->setClase($this);
        }

        return $this;
    }

    public function removeEspecializacion(Especializacion $especializacion): static
    {
        if ($this->especializacions->removeElement($especializacion)) {
            // set the owning side to null (unless already changed)
            if ($especializacion->getClase() === $this) {
                $especializacion->setClase(null);
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
            $jefe->setClase($this);
        }

        return $this;
    }

    public function removeJefe(Jefes $jefe): static
    {
        if ($this->jefes->removeElement($jefe)) {
            // set the owning side to null (unless already changed)
            if ($jefe->getClase() === $this) {
                $jefe->setClase(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Personaje>
     */
    public function getPersonajes(): Collection
    {
        return $this->personajes;
    }

    public function addPersonaje(Personaje $personaje): static
    {
        if (!$this->personajes->contains($personaje)) {
            $this->personajes->add($personaje);
            $personaje->setClase($this);
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): static
    {
        if ($this->personajes->removeElement($personaje)) {
            // set the owning side to null (unless already changed)
            if ($personaje->getClase() === $this) {
                $personaje->setClase(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin Clase';
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
            $enemigo->setClase($this);
        }

        return $this;
    }

    public function removeEnemigo(Enemigos $enemigo): static
    {
        if ($this->enemigos->removeElement($enemigo)) {
            // set the owning side to null (unless already changed)
            if ($enemigo->getClase() === $this) {
                $enemigo->setClase(null);
            }
        }

        return $this;
    }
}
