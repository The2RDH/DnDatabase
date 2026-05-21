<?php

namespace App\Entity;

use App\Repository\RazasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RazasRepository::class)]
class Razas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\ManyToOne(inversedBy: 'razas')]
    private ?Origen $origen = null;

    /**
     * @var Collection<int, Rasgos>
     */
    #[ORM\ManyToMany(targetEntity: Rasgos::class, inversedBy: 'razas')]
    private Collection $rasgos;

    /**
     * @var Collection<int, Jefes>
     */
    #[ORM\OneToMany(targetEntity: Jefes::class, mappedBy: 'raza')]
    private Collection $jefes;

    /**
     * @var Collection<int, Npc>
     */
    #[ORM\OneToMany(targetEntity: Npc::class, mappedBy: 'raza')]
    private Collection $npcs;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\OneToMany(targetEntity: Personaje::class, mappedBy: 'raza')]
    private Collection $personajes;

    /**
     * @var Collection<int, Enemigos>
     */
    #[ORM\ManyToMany(targetEntity: Enemigos::class, mappedBy: 'raza')]
    private Collection $enemigos;

    public function __toString(): string
    {
        return $this->nombre ?? 'Sin nombre';
    }

    public function __construct()
    {
        $this->rasgos = new ArrayCollection();
        $this->jefes = new ArrayCollection();
        $this->npcs = new ArrayCollection();
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

    public function getOrigen(): ?Origen
    {
        return $this->origen;
    }

    public function setOrigen(?Origen $origen): static
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * @return Collection<int, Rasgos>
     */
    public function getRasgos(): Collection
    {
        return $this->rasgos;
    }

    public function addRasgo(Rasgos $rasgo): static
    {
        if (!$this->rasgos->contains($rasgo)) {
            $this->rasgos->add($rasgo);
        }

        return $this;
    }

    public function removeRasgo(Rasgos $rasgo): static
    {
        $this->rasgos->removeElement($rasgo);

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
            $jefe->setRaza($this);
        }

        return $this;
    }

    public function removeJefe(Jefes $jefe): static
    {
        if ($this->jefes->removeElement($jefe)) {
            // set the owning side to null (unless already changed)
            if ($jefe->getRaza() === $this) {
                $jefe->setRaza(null);
            }
        }

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
            $npc->setRaza($this);
        }

        return $this;
    }

    public function removeNpc(Npc $npc): static
    {
        if ($this->npcs->removeElement($npc)) {
            // set the owning side to null (unless already changed)
            if ($npc->getRaza() === $this) {
                $npc->setRaza(null);
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
            $personaje->setRaza($this);
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): static
    {
        if ($this->personajes->removeElement($personaje)) {
            // set the owning side to null (unless already changed)
            if ($personaje->getRaza() === $this) {
                $personaje->setRaza(null);
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
            $enemigo->addRazas($this);
        }

        return $this;
    }

    public function removeEnemigo(Enemigos $enemigo): static
    {
        if ($this->enemigos->removeElement($enemigo)) {
            $enemigo->removeRazas($this);
        }

        return $this;
    }
}
